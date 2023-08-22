<?php

namespace Sikessem\UI\Components;

use Sikessem\UI\Base\BladeComponent;

class Label extends BladeComponent
{
    public function __construct(
        public ?string $text = null,
    ) {
    }
}
