<?php

namespace Sikessem\UI\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Sikessem\UI\Common\FormControl;
use Sikessem\UI\UIFacade;

class Input extends FormControl
{
    public string $name;

    public string $id;

    public bool $invalid;

    public ?string $value;

    public bool $chosen;

    public function __construct(
        string $type = 'text',
        string $name = null,
        string $id = null,
        string|array $value = null,
        string $current = null,
        string $default = null,
        bool $invalid = false,
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
        $this->invalid = $invalid;
        $this->value = $value;
        $this->chosen = isset($value) && ($value === old($name) || $value === 'on');
    }

    public function render(): View|Factory
    {
        $prefix = preg_quote(UIFacade::prefix(), '/');
        $suffix = 'input';
        if (preg_match("/$prefix-(?P<alias>.*?)-$suffix/", $this->componentName, $matches)) {
            $this->type = $matches['alias'];
        }

        return view('ui::components.input');
    }
}
