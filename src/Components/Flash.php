<?php

namespace Sikessem\UI\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Sikessem\UI\Core\BladeComponent;

class Flash extends BladeComponent
{
    public string $element;

    public string $message;

    public function __construct(string $type, string $message = null)
    {
        /** @var string */
        $element = config('ui.flash.element', 'p');
        $this->element = $element;
        $this->message = is_string($message = session($type, $message)) ? $message : '';
    }

    public function render(): View|Factory
    {
        return view('ui::components.flash');
    }
}
