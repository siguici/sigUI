<?php

namespace Sikessem\UI\Components\Input;

use Sikessem\UI\Components\Input;

class Month extends Input
{
    public function __construct(
        string $name = null,
        string $id = null,
        string|array $value = null,
        string $current = null,
        string $default = null,
        bool $invalid = false,
    ) {
        parent::__construct('month', $name, $id, $value, $current, $default, $invalid);
    }
}
