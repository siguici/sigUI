<?php

namespace Sigui\UI;

class Directives
{
    public static function ui(string $expression): string
    {
        return '{!! \Sigui\UI\Facade::make('.$expression.') !!}';
    }

    public static function tag(string $expression): string
    {
        return '{!! \Sigui\UI\Facade::openTag('.$expression.') !!}';
    }

    public static function endtag(): string
    {
        return '{!! \Sigui\UI\Facade::closeTag() !!}';
    }
}
