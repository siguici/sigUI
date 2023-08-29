<?php

namespace Sikessem\UI\Components;

use Sikessem\UI\Component;

class Flash extends Component
{
    public string $message;

    public function __construct(
        string $type,
        string $message = null,
        public string $tag = 'p',
        public ?string $icon = null,
    ) {
        $this->message = is_string($message = session($type, $message)) ? $message : '';
    }
}
