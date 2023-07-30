<?php

namespace Sikessem\UI\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Sikessem\UI\Common\BladeComponent;

class Link extends BladeComponent
{
    /**
     * @param  array<mixed>  $params
     */
    public function __construct(
        public string $href = '#',
        public ?string $text = null,
        public ?string $route = null,
        public array $params = [],
    ) {
    }

    public function render(): View|Factory
    {
        return view('ui::components.link');
    }
}
