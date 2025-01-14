<?php

namespace Sikessem\UI\Components;

use Sikessem\UI\Component;

class Link extends Component
{
    public string $href;

    /**
     * @param  string|array<mixed>  $parameters
     */
    public function __construct(
        string $href = '#',
        ?string $route = null,
        string|array $parameters = [],
        public ?string $text = null,
        public ?string $icon = null,
    ) {
        $parameters = (array) $parameters;
        if (is_null($route)) {
            /** @var string */
            $href = url($href, $parameters);
        }
        $href = $route ? route($route, $parameters) : $href;

        $this->href = $href;
    }
}
