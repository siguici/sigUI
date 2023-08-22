<?php

namespace Sikessem\UI\Components;

use Sikessem\UI\Base\BladeComponent;

class Error extends BladeComponent
{
    public string $element;

    public function __construct(public string $field, public string $stack = 'default')
    {
        /** @var string */
        $element = config('ui.error.element', 'p');
        $this->element = $element;
    }
}
