<?php

namespace Sikessem\UI;

class UIDirectives
{
    public static function ui(string $expression): string
    {
        return '{!! \Sikessem\UI\UIFacade::make('.$expression.') !!}';
    }

    public static function tag(string $expression): string
    {
        return '{!! \Sikessem\UI\UIFacade::openTag('.$expression.') !!}';
    }

    public static function endtag(): string
    {
        return '{!! \Sikessem\UI\UIFacade::closeTag() !!}';
    }
}
