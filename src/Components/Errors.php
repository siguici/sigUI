<?php

namespace Sigui\UI\Components;

use Sigui\UI\Component;

class Errors extends Component
{
    public function __construct(
        public string $tag = 'ul',
        public string $errorTag = 'li',
        public ?string $icon = null,
    ) {}
}
