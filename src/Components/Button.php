<?php

namespace Sikessem\UI\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Sikessem\UI\Core\BladeComponent;

class Button extends BladeComponent
{
    /**
     * @param  array<mixed>  $params
     */
    public function __construct(
        public string $type = 'button',
        public ?string $href = null,
        public ?string $text = null,
        public ?string $route = null,
        public array $params = [],
    ) {
    }

    public function render(): View|Factory
    {
        return view('ui::components.button');
    }
}
