<?php

namespace Sikessem\UI\Components;

use InvalidArgumentException;
use Sikessem\UI\Base\FormControl;

class Entry extends FormControl
{
    public string $name;

    public string $id;

    public bool|string $autocomplete;

    public function __construct(
        string $type = 'text',
        string $name = null,
        string $id = null,
        bool|string $autocomplete = false,
        public array $datalist = [],
    ) {
        parent::__construct($type);

        if (! in_array($this->type, [
            'color',
            'date',
            'datetime-local',
            'email',
            'file',
            'month',
            'number',
            'password',
            'range',
            'search',
            'tel',
            'text',
            'textarea',
            'time',
            'url',
            'week',
        ])) {
            throw new InvalidArgumentException("Cannot use $type as entry");
        }

        $name ??= $type;
        $id ??= $name;
        $autocomplete = is_string($autocomplete) ? $autocomplete : $name;
        $this->name = $name;
        $this->id = $id;
        $this->autocomplete = $autocomplete;
    }
}
