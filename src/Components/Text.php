<?php

namespace Sikessem\UI\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Sikessem\UI\Core\BladeComponent;

class Text extends BladeComponent
{
    public function __construct(
        public string $value = '',
        public bool $escape = false,
        public bool $translate = false,
    ) {
    }

    public function render(): View|Factory
    {
        return view('ui::components.text');
    }

    /**
     * Whether the component should be rendered
     */
    public function shouldRender(): bool
    {
        return ! empty($this->value);
    }
}
