<?php

namespace Sikessem\UI\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Sikessem\UI\Core\BladeComponent;

class Text extends BladeComponent
{
    public function __construct(
        public ?string $value = null,
        public bool $escaped = false,
        public bool $translated = false,
    ) {
    }

    public function render(): View|Factory
    {
        return view('ui::components.text');
    }
}
