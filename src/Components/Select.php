<?php

namespace Sikessem\UI\Components;

use Sikessem\UI\FormControl;

class Select extends FormControl
{
    public string $name;

    public string $id;

    public ?string $value;

    public function __construct(
        string $name,
        string $id = null,
        string|array $value = null,
        string $current = null,
        string $default = null,
        public array $options = [],
        public bool $invalid = false,
    ) {
        parent::__construct('select');
        $id ??= $name;
        $value = (array) $value;
        $current ??= $value['current'] ?? $value[0] ?? null;
        $default ??= $value['default'] ?? $value[1] ?? $value[0] ?? null;
        $value = old($name) ?: $current ?? $default;
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
    }
}
