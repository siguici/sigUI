<?php

namespace Sikessem\UI;

use Illuminate\Support\Str;
use Illuminate\View\Compilers\ComponentTagCompiler;
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
        return preg_replace_callback("/<\/\s*s-([\w\-\.]*)\s*>/", function (array $matches) {
            return (Facade::find($matches[1]))
            ? ' '.$this->endComponentString()
            : '';
        }, $value) ?: parent::compileClosingTags($value);
    }

    /**
     * @param  array<mixed>  $attributes
     */
    protected function componentString(string $component, array $attributes, string $contents = null): string
    {
        if ($info = Facade::find($component)) {
            ['class' => $class, 'alias' => $component] = $info;

            $attributes = collect(
                $this->getAttributesFromAttributeString(Facade::makeComponentAttributes($component)->toHtml())
            )->merge(
                $attributes
            )->toArray();

            $alias = Facade::prefix()."-$component";

            if (! isset($this->aliases[$alias])) {
                $this->aliases[$alias] = $class;
            }

            $render = parent::componentString($alias, $attributes);

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

    protected function endComponentString(): string
    {
        return '@endComponentClass##END-COMPONENT-CLASS##';
    }
}
