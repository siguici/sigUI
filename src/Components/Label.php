<?php

namespace Sigui\UI\Components;

use Sigui\UI\Component;

class Label extends Component
{
    public function __construct(
        public ?string $text = null,
        public ?string $icon = null,
    ) {}
}
