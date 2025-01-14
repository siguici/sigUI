<?php

namespace Sikessem\UI;

use Closure;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component as BaseComponent;
use Sikessem\UI\Contracts\IsComponent;

abstract class Component extends BaseComponent implements IsComponent
{
    public function render(): View|Factory|Closure
    {
        $prefix = preg_quote(Facade::prefix(), '/');
        $alias = Facade::getAlias(static::class);

        return view("$prefix::components.$alias");
    }
}
