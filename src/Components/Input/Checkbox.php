<?php

namespace Sikessem\UI\Components\Input;

use Sikessem\UI\Components\Input;

class Checkbox extends Input
{
    public function __construct(
        string $name = null,
        string $id = null,
        string|array $value = [],
        string $current = null,
        string $default = null,
        bool $invalid = false,
    ) {
        parent::__construct('checkbox', $name, $id, $value, $current, $default, $invalid);
    }
}
