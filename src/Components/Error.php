<?php

namespace Sikessem\UI\Components;

use Sikessem\UI\Component;

class Error extends Component
{
    public function __construct(public string $field, public string $stack = 'default', public string $tag = 'p')
    {
    }
}
