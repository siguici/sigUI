<?php

namespace Sikessem\UI\Core;

class Directives
{
    public static function ui(string $expression): string
    {
        return '{!! \Sikessem\UI\Core\Facade::make('.$expression.') !!}';
    }
}
