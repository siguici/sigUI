<?php

namespace Sikessem\UI\Components;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Sikessem\UI\Common\BladeComponent;

class HelloBlade extends BladeComponent
{
    public function render(): View|Factory|Htmlable|Closure|string
    {
        return 'Hello';
    }
}
