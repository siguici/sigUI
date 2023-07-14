<?php

namespace Sikessem\UI\Core;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\Str;
use Livewire\Livewire;

class Manager
{
    public const COMPONENT_NAMESPACE = 'Sikessem\\UI\\Components';

    public const ANONYMOUS_COMPONENT_NAMESPACE = 'ui::components';

    /**
     * @var array<string,string>;
     */
    protected array $components = [];

    public function component(string $class, string $alias = null, bool $anonymous = false): void
    {
        $alias ??= $anonymous ? $class : Str::snake($class, '-');

        if (! isset($this->components[$alias])) {
            $class = ($anonymous ? Manager::ANONYMOUS_COMPONENT_NAMESPACE.'.' : Manager::COMPONENT_NAMESPACE.'\\').$class;
            $this->components[$alias] = $class;

            if (! $anonymous && is_subclass_of($class, LivewireComponent::class)) {
                Livewire::component("ui-$alias", $class);
            } else {
                Blade::component($class, $alias, 'ui');
            }
        }

    }

    /**
     * @param  Arrayable<int|string,mixed>|mixed[]  $data
     * @param  Arrayable<int|string,mixed>|mixed[]  $layoutData
     */
    public function page(string $content, Arrayable|array $data = [], string $layout = null, Arrayable|array $layoutData = [], array $mergeData = []): ViewContract
    {
        if (isset($layout)) {
            $content = ViewFacade::make("contents.$content", $data, $mergeData)->render();

            return ViewFacade::make("layouts.$layout", compact('content') + $layoutData, array_merge($data instanceof Arrayable ? $data->toArray() : $data, $mergeData));
        }

        return ViewFacade::make("pages.$content", $data, $mergeData);
    }

    /**
     * @param  mixed[]  $data
     */
    public function render(string $content, array $data = [], bool $deleteCachedView = false): string
    {
        return Blade::render($content, $data, $deleteCachedView);
    }
}
