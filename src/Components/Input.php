<?php

namespace Sikessem\UI\Components;

use Sikessem\UI\Concerns\HandlesComponentAlias;
use Sikessem\UI\FormControl;

class Input extends FormControl
{
    use HandlesComponentAlias;

    public string $name;

    public string $id;

    public ?string $value;

    public bool $chosen;

    public function __construct(
        string $type = 'text',
        ?string $name = null,
        ?string $id = null,
        string|array|null $value = null,
        ?string $current = null,
        ?string $default = null,
        public bool $invalid = false,
        public ?string $icon = null,
    ) {
        parent::__construct($type);

        $name ??= $type;
        $id ??= $name;
        $value = (array) $value;
        $current ??= $value['current'] ?? $value[0] ?? null;
        $default ??= $value['default'] ?? $value[1] ?? $value[0] ?? null;
        $value = old($name) ?: $current ?? $default;
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->chosen = isset($value) && ($value === old($name) || $value === 'on');
    }
}
