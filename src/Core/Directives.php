<?php

namespace Sikessem\UI\Core;

class Directives
{
    public static function s(string $expression): string
    {
        return '{!! \Sikessem\UI\Core\Facade::make('.$expression.') !!}';
    }

    public static function ui(string $expression): string
    {
        return '{!! \Sikessem\UI\Core\Facade::open('.$expression.') !!}';
    }

    public static function endui(): string
    {
        return '{!! \Sikessem\UI\Core\Facade::close() !!}';
    }
}
