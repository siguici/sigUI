<?php

namespace Sikessem\UI\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Sikessem\UI\Core\BladeComponent;

class Label extends BladeComponent
{
    public function __construct(
        public ?string $text = null,
    ) {
    }

    public function render(): View|Factory
    {
        return view('ui::components.label');
    }
}
