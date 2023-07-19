<?php

namespace Sikessem\UI\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\ComponentAttributeBag;
use Sikessem\UI\Core\BladeComponent;

class Flashes extends BladeComponent
{
    /**
     * @param  array<mixed>  $list
     * @param  array<string,string>|ComponentAttributeBag  $flashAttributes
     */
    public function __construct(
        public array $list = [],
        public string $element = 'ul',
        public string $flashElement = 'li',
        public array|ComponentAttributeBag $flashAttributes = [],
    ) {
    }

    public function render(): View|Factory
    {
        return view('ui::components.flashes');
    }
}
