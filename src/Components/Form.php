<?php

namespace Sigui\UI\Components;

use Sigui\UI\Component;

class Form extends Component
{
    public string $action;

    public string $method;

    /**
     * @param  string|array<mixed>  $parameters
     */
    public function __construct(
        string $method = 'GET',
        string $action = '#',
        ?string $route = null,
        string|array $parameters = [],
        public bool $hasFiles = false,
    ) {
        $method = strtoupper($method);
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
}
