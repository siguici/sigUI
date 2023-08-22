<?php

namespace Sikessem\UI\Base;

use Closure;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Sikessem\UI\Contracts\IsBladeComponent;
use Sikessem\UI\UIFacade;

abstract class BladeComponent extends Component implements IsBladeComponent
{
    public function render(): View|Factory|Closure
    {
        $prefix = preg_quote(UIFacade::prefix(), '/');
        $alias = UIFacade::getAlias(get_class($this));

        return view("$prefix::components.$alias");
    }
}
