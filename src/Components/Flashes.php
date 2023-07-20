<?php

namespace Sikessem\UI\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\ComponentAttributeBag;
use Sikessem\UI\Core\BladeComponent;

class Flashes extends BladeComponent
{
    public string $element;

    /**
     * @var Collection<int|string,string>
     */
    public Collection $messages;

    public string $flashElement;

    /**
     * @var array<string|string>|ComponentAttributeBag
     */
    public array|ComponentAttributeBag $flashAttributes = [];

    /**
     * @param  array<int|string,string>  $messages
     */
    public function __construct(array $messages = [])
    {
        /** @var string */
        $element = config('ui.flashes.element', 'ul');
        /** @var string */
        $flashElement = config('ui.flashes.flash.element', 'li');
        /** @var array<string|string>|ComponentAttributeBag */
        $flashAttributes = config('ui.flashes.flash.attributes', []);
        $this->element = $element;
        $this->flashElement = $flashElement;
        $this->flashAttributes = $flashAttributes;

        $messages = collect($messages)
            ->map(function ($message, $type) {
                /** @var string */
                $message = is_int($type) ? session($message, '') : session($type, $message);

                return $message;
            })
            ->filter(function ($message) {
                return ! empty($message);
            });
        $this->messages = $messages;
    }

    public function render(): View|Factory
    {
        return view('ui::components.flashes');
    }
}
