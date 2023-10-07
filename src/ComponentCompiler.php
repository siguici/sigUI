<?php

namespace Sikessem\UI;

use Illuminate\Support\Str;
use Illuminate\View\Compilers\ComponentTagCompiler;
use Illuminate\View\DynamicComponent;
use Sikessem\UI\Contracts\IsComponentCompiler;

class ComponentCompiler extends ComponentTagCompiler implements IsComponentCompiler
{
    /**
     * Compile the component and slot tags within the given string.
     *
     * @return string
     */
    public function compile(string $value)
    {
        $value = $this->compileSlots($value);
        $value = $this->compileTags($value);

        return $value;
    }

    /**
     * Compile the slot tags within the given string.
     */
    public function compileSlots(string $value): string
    {
        $pattern = "/
            <
                \s*
                s:
                (?<inlineName>\w+(?:-\w+)*)
                {$this->attributesPattern($value)}
                (?<![\/=\-])
            >
        /x";

        $value = preg_replace_callback($pattern, function ($matches) {
            $name = $this->stripQuotes($matches['inlineName']);

            if (Str::contains($name, '-')) {
                $name = Str::camel($name);
            }

            $name = "'{$name}'";

            $this->boundAttributes = [];

            $attributes = $this->getAttributesFromAttributeString($matches['attributes']);

            return " @slot({$name}, null, [".$this->attributesToString($attributes).']) ';
        }, $value) ?: $value;

        $value = preg_replace('/<\/\s*s:[^>]*>/', ' @endslot', $value) ?: $value;

        return $value;
    }

    /**
     * Compile the tags within the given string.
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function compileTags(string $value)
    {
        $value = $this->compileSelfClosingTags($value);
        $value = $this->compileOpeningTags($value);
        $value = $this->compileClosingTags($value);

        return $value;
    }

    /**
     * Compile the self-closing tags within the given string.
     *
     * @throws \InvalidArgumentException
     */
    protected function compileSelfClosingTags(string $value): string
    {
        $pattern = "/
            <
                \s*
                s-([\w\-\.]*)
                \s*
                {$this->attributesPattern($value)}
            \/>
        /x";

        return preg_replace_callback($pattern, function (array $matches) {
            $this->boundAttributes = [];

            $component = $matches[1];
            $attributes = $this->getAttributesFromAttributeString($matches['attributes']);

            return $this->componentString($component, $attributes);
        }, $value) ?: $value;
    }

    /**
     * Compile the opening tags within the given string.
     *
     * @throws \InvalidArgumentException
     */
    protected function compileOpeningTags(string $value): string
    {
        $pattern = "/
            <
                \s*
                s-([\w\-\.]*)
                {$this->attributesPattern($value)}
                (?<![\/=\-])
            >
        /x";

        return preg_replace_callback($pattern, function (array $matches) {
            $this->boundAttributes = [];

            $component = $matches[1];
            $attributes = $this->getAttributesFromAttributeString($matches['attributes']);

            return $this->componentString($component, $attributes, '');
        }, $value) ?: $value;
    }

    /**
     * Compile the closing tags within the given string.
     */
    protected function compileClosingTags(string $value): string
    {
        return preg_replace_callback("/<\/\s*s-([\w\-\.]*)\s*>/", fn (array $matches) => (Facade::find($matches[1]))
        ? ' '.$this->endComponentString()
        : '', $value) ?: parent::compileClosingTags($value);
    }

    /**
     * @param  array<mixed>  $attributes
     */
    protected function componentString(string $component, array $attributes, string $contents = null): string
    {
        if ($info = Facade::find($component)) {
            ['class' => $class, 'alias' => $alias] = $info;

            $tag = Facade::makeComponentTag($alias);

            $alias = Facade::prefix()."-$alias";

            $attributes = collect(
                $this->getAttributesFromAttributeString($tag->getAttributes()->toHtml())
            )->merge(
                $attributes
            )->toArray();

            [$data, $attributes] = $this->partitionDataAndAttributes($class, $attributes);

            $data = $data->mapWithKeys(fn ($value, $key) => [Str::camel($key) => $value]);

            $parameters = $data->all();

            $render = "##BEGIN-COMPONENT-CLASS##@component('{$class}', '{$alias}', [".$this->attributesToString($parameters, $escapeBound = false).'])
    <?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass('.$class.'::class))->getConstructor()): ?>
    <?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
    <?php endif; ?>
    <?php $component->withAttributes(['.$this->attributesToString($attributes->all(), $escapeAttributes = $class !== DynamicComponent::class).']); ?>';

            if (is_null($contents)) {
                $render .= "\n".$this->endComponentString();
            }

            return $render;
        }

        return parent::componentString($component, $attributes);
    }

    protected function attributesPattern(string $value): string
    {
        return "
        (?<attributes>
            (?:
                \s+
                (?:
                    (?:
                        @(?:class)(\( (?: (?>[^()]+) | (?-1) )* \))
                    )
                    |
                    (?:
                        @(?:style)(\( (?: (?>[^()]+) | (?-1) )* \))
                    )
                    |
                    (?:
                        \{\{\s*\\\$attributes(?:[^}]+?)?\s*\}\}
                    )
                    |
                    (?:
                        (\:\\\$)(\w+)
                    )
                    |
                    (?:
                        [\w\-:.@%]+
                        (
                            =
                            (?:
                                \\\"[^\\\"]*\\\"
                                |
                                \'[^\']*\'
                                |
                                [^\'\\\"=<>]+
                            )
                        )?
                    )
                )
            )*
            \s*
        )";
    }

    protected function slotToString(string $slot): string
    {
        return addslashes($slot);
    }

    protected function endComponentString(): string
    {
        return '@endComponentClass##END-COMPONENT-CLASS##';
    }
}
