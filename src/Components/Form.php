<?php

namespace Sikessem\UI\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Sikessem\UI\Common\BladeComponent;

class Form extends BladeComponent
{
    public function __construct(
        public string $method = 'GET',
        public string $action = '#',
        public ?string $route = null,
        public array $params = [],
        public bool $hasFiles = false,
    ) {
    }

    public function render(): View|Factory
    {
        return view('ui::components.form');
    }
}
