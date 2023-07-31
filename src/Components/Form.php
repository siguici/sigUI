<?php

namespace Sikessem\UI\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Sikessem\UI\Common\BladeComponent;

class Form extends BladeComponent
{
    public string $action;

    public string $method;

    /**
     * @param  string|array<mixed>  $parameters
     */
    public function __construct(
        string $method = 'GET',
        string $action = '#',
        string $route = null,
        string|array $parameters = [],
        public bool $hasFiles = false,
    ) {
        $method = strtoupper($method);
        $method === 'GET' ? $method : 'POST';
        $parameters = (array) $parameters;
        if (is_null($route)) {
            /** @var string */
            $action = url($action, $parameters);
        }
        $action = $route ? route($route, $parameters) : $action;

        $this->method = $method;
        $this->action = $action;
        $this->hasFiles = $hasFiles;
    }

    public function render(): View|Factory
    {
        return view('ui::components.form');
    }
}
