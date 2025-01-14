<?php

namespace Sigui\UI;

abstract class FormControl extends Component
{
    public string $type;

    public function __construct(string $type = 'text')
    {
        $this->type = strtolower($type);
    }
}
