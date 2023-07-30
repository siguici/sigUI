<?php

namespace Sikessem\UI;

class UIDirectives
{
    public static function s(string $expression): string
    {
        return '{!! \Sikessem\UI\UIFacade::make('.$expression.') !!}';
    }

    public static function ui(string $expression): string
    {
        return '{!! \Sikessem\UI\UIFacade::open('.$expression.') !!}';
    }

    public static function endui(): string
    {
        return '{!! \Sikessem\UI\UIFacade::close() !!}';
    }
}
