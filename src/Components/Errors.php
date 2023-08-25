<?php

namespace Sikessem\UI\Components;

use Sikessem\UI\Component;

class Errors extends Component
{
    public function __construct(public string $tag = 'ul', public string $errorTag = 'li')
    {
    }
}
