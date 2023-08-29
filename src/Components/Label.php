<?php

namespace Sikessem\UI\Components;

use Sikessem\UI\Component;

class Label extends Component
{
    public function __construct(
        public ?string $text = null,
        public ?string $icon = null,
    ) {
    }
}
