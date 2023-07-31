<?php

namespace Sikessem\UI\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Sikessem\UI\Common\BladeComponent;

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

    public function render(): View|Factory
    {
        return view('ui::components.link');
    }
}
