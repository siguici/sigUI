<?php

namespace Sikessem\UI\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Sikessem\UI\Common\BladeComponent;

class Error extends BladeComponent
{
    public string $element;

    public function __construct(public string $field, public string $stack = 'default')
    {
        /** @var string */
        $element = config('ui.error.element', 'p');
        $this->element = $element;
    }

    public function render(): View|Factory
    {
        return view('ui::components.error');
    }
}
