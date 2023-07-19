<?php

namespace Sikessem\UI\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\ComponentAttributeBag;
use Sikessem\UI\Core\BladeComponent;

class Menu extends BladeComponent
{
    /**
     * @param  array<mixed>  $list
     * @param  array<string,string>|ComponentAttributeBag  $itemAttributes
     */
    public function __construct(
        public array $list = [],
        public bool $ordered = false,
        public array|ComponentAttributeBag $itemAttributes = [],
    ) {
    }

    public function render(): View|Factory
    {
        return view('ui::components.menu');
    }
}
