<?php

namespace Sikessem\UI\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Sikessem\UI\Common\FormControl;

class Entry extends FormControl
{
    public string $name;

    public string $id;

    public bool|string $autocomplete;

    public ?string $value;

    public bool $chosen;

    public function __construct(
        string $type = 'text',
        string $name = null,
        string $id = null,
        bool|string $autocomplete = false,
        string|array $value = [],
        string $currentValue = null,
        string $defaultValue = null,
    ) {
        parent::__construct($type);

        $name ??= $type;
        $id ??= $name;
        $autocomplete = is_string($autocomplete) ? $autocomplete : $name;
        $value = (array) $value;
        $currentValue ??= $value['current'] ?? $value[0] ?? null;
        $defaultValue ??= $value['default'] ?? $value[1] ?? $value[0] ?? null;
        $value = old($name) ?: $currentValue ?? $defaultValue;
        $this->name = $name;
        $this->id = $id;
        $this->autocomplete = $autocomplete;
        $this->value = $value;
        $this->chosen = isset($value) && ($value === old($name) || $value === 'on');
    }

    public function render(): View|Factory
    {
        return view('ui::components.entry');
    }
}
