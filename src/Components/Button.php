<?php

namespace Sikessem\UI\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Sikessem\UI\Common\FormControl;
use Sikessem\UI\UIFacade;

class Button extends FormControl
{
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

    public function render(): View|Factory
    {
        $prefix = preg_quote(UIFacade::prefix(), '/');
        $suffix = 'button';
        if (preg_match("/$prefix-(?P<alias>.*?)-$suffix/", $this->componentName, $matches)) {
            $this->type = $matches['alias'];
        }

        return view('ui::components.button');
    }
}
