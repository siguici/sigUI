<?php

namespace Sikessem\UI\Components;

use Sikessem\UI\Base\BladeComponent;

class Text extends BladeComponent
{
    public function __construct(
        public ?string $element = null,
        public ?string $value = null,
        public bool $escape = false,
        public bool $translate = false,
    ) {
    }
}
