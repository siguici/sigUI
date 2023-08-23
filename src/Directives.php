<?php

namespace Sikessem\UI;

class Directives
{
    public static function ui(string $expression): string
    {
        return '{!! \Sikessem\UI\Facade::make('.$expression.') !!}';
    }

    public static function tag(string $expression): string
    {
        return '{!! \Sikessem\UI\Facade::openTag('.$expression.') !!}';
    }

    public static function endtag(): string
    {
        return '{!! \Sikessem\UI\Facade::closeTag() !!}';
    }
}
