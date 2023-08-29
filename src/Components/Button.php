<?php

namespace Sikessem\UI\Components;

use Sikessem\UI\Concerns\HandlesComponentAlias;
use Sikessem\UI\FormControl;

class Button extends FormControl
{
    use HandlesComponentAlias;

    public ?string $href = null;

    /**
     * @param  array<mixed>  $parameters
     */
    public function __construct(
        string $type = 'button',
        string $href = null,
        string $route = null,
        string|array $parameters = [],
        public ?string $name = null,
        public ?string $value = null,
        public ?string $text = null,
        public ?string $icon = null,
    ) {
        parent::__construct($type);

        $parameters = (array) $parameters;
        if (! is_null($href) || ! is_null($route)) {
            $parameters = (array) $parameters;
            if (is_null($route)) {
                /** @var string */
                $href = url($href, $parameters);
            }
            $href = $route ? route($route, $parameters) : $href;
        }

        $this->type = $type;
        $this->href = $href;
    }
}
