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
        $value = $this->compileSelfClosingTags($value);

        return $value;
    }

    /**
     * Compile the self-closing tags within the given string.
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function compileSelfClosingTags(string $value)
    {
        $pattern = "/
            <
                \s*
                s[-\:]([\w\-\:\.]*)
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
                    $render .= "\n@endComponentClass##END-COMPONENT-CLASS##";
                }
            } else {
                $slot = new ComponentSlot($contents ?? '', $attributes);
                $render = "@livewire('ui-$alias', [".$this->attributesToString($attributes, escapeBound: false)."], key({$slot->toHtml()}))";
            }
        }

        return $render;
    }
}
