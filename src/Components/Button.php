<?php

namespace Sikessem\UI\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Sikessem\UI\Common\BladeComponent;

class Button extends BladeComponent
{
    public string $type = 'button';

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
    ) {
        $type = strtolower($type);
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

    public function render(): View|Factory
    {
        return view('ui::components.button');
    }
}
