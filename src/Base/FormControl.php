<?php

namespace Sikessem\UI\Base;

abstract class FormControl extends BladeComponent
{
    public string $type;

    public function __construct(string $type = 'text')
    {
        $this->type = strtolower($type);
    }
}
