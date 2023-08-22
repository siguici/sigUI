<?php

namespace Sikessem\UI\Components;

use Illuminate\View\ComponentAttributeBag;
use Sikessem\UI\Component;

class Errors extends Component
{
    public string $element;

    public string $errorElement;

    /**
     * @var array<string|string>|ComponentAttributeBag
     */
    public array|ComponentAttributeBag $errorAttributes = [];

    public function __construct()
    {
        /** @var string */
        $element = config('ui.errors.element', 'ul');
        /** @var string */
        $errorElement = config('ui.errors.error.element', 'li');
        /** @var array<string|string>|ComponentAttributeBag */
        $errorAttributes = config('ui.errors.error.attributes', []);
        $this->element = $element;
        $this->errorElement = $errorElement;
        $this->errorAttributes = $errorAttributes;
    }
}
