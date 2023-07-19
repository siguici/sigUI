<?php

namespace Sikessem\UI\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Sikessem\UI\Core\BladeComponent;

class Flash extends BladeComponent
{
    public function __construct(
        public string $type,
        public string $element = 'p',
        public ?string $text = null,
    ) {
    }

    public function render(): View|Factory
    {
        return view('ui::components.flash');
    }
}
