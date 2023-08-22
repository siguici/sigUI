<?php

namespace Sikessem\UI\Components;

use Sikessem\UI\Component;

class Text extends Component
{
    public function __construct(
        public ?string $element = null,
        public ?string $value = null,
        public bool $escape = false,
        public bool $translate = false,
    ) {
    }
}
