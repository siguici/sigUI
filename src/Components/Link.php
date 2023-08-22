<?php

namespace Sikessem\UI\Components;

use Sikessem\UI\Base\BladeComponent;

class Link extends BladeComponent
{
    public string $href;

    /**
     * @param  string|array<mixed>  $parameters
     */
    public function __construct(
        string $href = '#',
        string $route = null,
        string|array $parameters = [],
        public ?string $text = null,
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
