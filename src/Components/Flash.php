<?php

namespace Sikessem\UI\Components;

use Sikessem\UI\Component;

class Flash extends Component
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
}
