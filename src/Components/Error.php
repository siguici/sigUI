<?php

namespace Sigui\UI\Components;

use Sigui\UI\Component;

class Error extends Component
{
    public function __construct(
        public string $field,
        public string $stack = 'default',
        public string $tag = 'p',
        public ?string $icon = null
    ) {}
}
