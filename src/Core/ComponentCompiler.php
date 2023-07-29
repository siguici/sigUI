<?php

namespace Sikessem\UI\Core;

use Illuminate\View\Compilers\ComponentTagCompiler;
use Illuminate\View\ComponentSlot;
use Sikessem\UI\Contracts\ComponentCompilerContract;

class ComponentCompiler extends ComponentTagCompiler implements ComponentCompilerContract
{
    /**
     * Compile the component and slot tags within the given string.
     *
     * @return string
     */
    public function compile(string $value)
    {
        $value = $this->compileTags($value);

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
        }, $value) ?: '';
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
        }, $value) ?: '';
    }

    /**
     * Compile the closing tags within the given string.
     */
    protected function compileClosingTags(string $value): string
    {
        return preg_replace_callback("/<\/\s*s-([\w\-\.]*)\s*>/", function (array $matches) {
            return ($component = Facade::find($matches[1])) && Facade::isBlade($component['class'])
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

        if ($info = Facade::find($component)) {
            ['class' => $class, 'alias' => $alias] = $info;

            if (Facade::isBlade($class)) {
                if (! isset($this->aliases[$alias])) {
                    $this->aliases[$alias] = $class;
                }

                $render = parent::componentString($alias, $attributes);

                if (is_null($contents)) {
                    $render .= "\n".$this->endComponentString();
                }
            } else {
                $slot = new ComponentSlot($contents ?? '', $attributes);
                $render = "@livewire('ui-$alias', [".$this->attributesToString($attributes, escapeBound: false)."], key({$slot->toHtml()}))";
            }
        }

        return $render;
    }

    protected function endComponentString(): string
    {
        return '@endComponentClass##END-COMPONENT-CLASS##';
    }
}
