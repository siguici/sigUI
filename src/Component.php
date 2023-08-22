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
        $prefix = preg_quote(UIFacade::prefix(), '/');
        $alias = UIFacade::getAlias(get_class($this));

        return view("$prefix::components.$alias");
    }
}
