<?php

namespace Sikessem\UI\Components;

use Illuminate\View\ComponentAttributeBag;
use Sikessem\UI\Base\BladeComponent;

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
}
