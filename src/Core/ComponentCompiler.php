<?php

namespace Sikessem\UI\Core;

use Illuminate\View\Compilers\ComponentTagCompiler;
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
                ui[-\:]([\w\-\:\.]*)
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
    protected function componentString(string $component, array $attributes, string $content = null)
    {
        return "@ui('{$component}', [".$this->attributesToString($attributes, escapeBound: false).'])';
    }
}
