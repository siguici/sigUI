<?php

namespace Sikessem\UI;

use Illuminate\Support\Str;
use Illuminate\View\Compilers\ComponentTagCompiler;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\ComponentSlot;
use Sikessem\UI\Contracts\ComponentCompilerContract;

class UIComponentCompiler extends ComponentTagCompiler implements ComponentCompilerContract
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
                                [\w\-:.@]+
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
                )
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
                )
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
                )
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
            return ($component = UIFacade::find($matches[1])) && UIFacade::isBlade($component['class'])
            ? ' '.$this->endComponentString()
            : '';
        }, $value) ?: '';
    }

    /**
     * @param  array<mixed>  $attributes
     */
    protected function componentString(string $component, array $attributes, string $contents = null): string
    {
        $render = '';

        if ($info = UIFacade::find($component)) {
            ['class' => $class, 'alias' => $alias] = $info;
            $alias = UIFacade::prefix()."-$alias";
            $attributes = (new ComponentAttributeBag($attributes))->merge((array) config("ui.components.$component.attributes", []))->getAttributes();

            if (UIFacade::isBlade($class)) {
                if (! isset($this->aliases[$alias])) {
                    $this->aliases[$alias] = $class;
                }

                $render = parent::componentString($alias, $attributes);

                if (is_null($contents)) {
                    $render .= "\n".$this->endComponentString();
                }
            } else {
                $slot = new ComponentSlot($contents ?? '', $attributes);
                $render = "@livewire('$alias', [".$this->attributesToString($slot->attributes->getAttributes(), escapeBound: false).']'.($slot->isEmpty() ? '' : ", key({$slot->toHtml()})").')';
            }
        } else {
            $render = parent::componentString($component, $attributes);
        }

        return $render;
    }

    protected function endComponentString(): string
    {
        return '@endComponentClass##END-COMPONENT-CLASS##';
    }
}
