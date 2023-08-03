<?php

namespace Sikessem\UI\Components;

class ResetButton extends Button
{
    /**
     * @param  array<mixed>  $parameters
     */
    public function __construct(
        string $href = null,
        string $route = null,
        string|array $parameters = [],
        public ?string $name = null,
        public ?string $value = null,
        public ?string $text = null,
    ) {
        parent::__construct('reset', $href, $route, $parameters, $name, $value, $text);
    }
}
