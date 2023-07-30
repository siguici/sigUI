<?php

namespace Sikessem\UI\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Sikessem\UI\Common\BladeComponent;

class Entry extends BladeComponent
{
    public string $type;

    public string $name;

    public string $id;

    public ?string $value;

    public string $autocomplete;

    public function __construct(
        string $type = 'text', // email, password, number, search, color, date, ...
        string $name = null,
        string $id = null,
        string $autocomplete = null,
        string|array $value = [],
        string $current = null,
        string $default = null,
    ) {
        $type = strtolower($type);
        $name ??= $type;
        $id ??= $name;
        $autocomplete ??= $name;
        $value = (array) $value;
        $current = $value['current'] ?? $value[0] ?? $current;
        $default = $value['default'] ?? $value[1] ?? $default;
        $this->type = $type;
        $this->name = $name;
        $this->id = $id;
        $this->autocomplete = $autocomplete;
        $this->value = old($name) ?: $current ?? $default;
    }

    public function render(): View|Factory
    {
        return view('ui::components.entry');
    }
}
