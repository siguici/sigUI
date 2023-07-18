<?php

namespace Sikessem\UI\Core;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\Str;
use Livewire\Livewire;
use RuntimeException;

class Manager
{
    public const COMPONENT_NAMESPACE = 'Sikessem\\UI\\Components';

    public const ANONYMOUS_COMPONENT_NAMESPACE = 'ui::components';

    /**
     * @var array<string,string>;
     */
    protected array $components = [];

    /**
     * @var array<string>
     */
    protected array $tags = [];

    public function component(string $class, string $alias = null, bool $anonymous = false): void
    {
        $alias ??= $anonymous ? $class : Str::snake($class, '-');

        if (! isset($this->components[$alias])) {
            $class = ($anonymous ? Manager::ANONYMOUS_COMPONENT_NAMESPACE.'.' : Manager::COMPONENT_NAMESPACE.'\\').$class;
            $this->components[$alias] = $class;

            if ($this->isLivewire($class, $anonymous)) {
                Livewire::component("ui-$alias", $class);
            } else {
                Blade::component($class, $alias, 'ui');
            }
        }
    }

    /**
     * @param  array<string>  $classes
     */
    public function components(array $classes = [], bool $anonymous = false): void
    {
        foreach ($classes as $class => $alias) {
            if (is_int($class)) {
                $class = $alias;
                $alias = null;
            }
            $this->component($class, $alias, $anonymous);
        }
    }

    /**
     * @return array{class:string,alias:string}|null
     */
    public function find(string $name): ?array
    {
        foreach ($this->components as $alias => $class) {
            if ($alias === $name || $class === $name) {
                return ['class' => $class, 'alias' => $alias];
            }
        }

        return null;
    }

    /**
     * @param  array<string,string>  $attributes
     */
    public function make(string $name, array $attributes = [], string $contents = null): string
    {
        $slot = new ComponentSlot($contents ?: '', $attributes);

        if ($render = $this->build($name, $slot)) {
            return $render;
        }

        array_push($this->tags, $name);

        $render = "<{$name} {$slot->attributes->toHtml()}>";

        if (! $slot->isEmpty()) {
            $render .= $slot->toHtml()."</{$name}>";
        }

        return $render;
    }

    public function build(string $name, ComponentSlot $slot): string
    {
        $render = '';

        if ($component = $this->find($name)) {
            ['class' => $class, 'alias' => $alias] = $component;

            if ($this->isLivewire($class)) {
                $render = $slot->isEmpty()
                ? '<livewire:ui-'.$alias.' '.$slot->attributes->toHtml().'>'
                : "@livewire('ui-$alias', ".$this->stringifyAttributes($slot->attributes->getAttributes()).", key({$slot->toHtml()}))";
            } else {
                $render = "<x-ui-$alias {$slot->attributes->toHtml()}";
                $render .= $slot->isEmpty() ? '/>' : "</x-ui-$alias>";
            }

            $render = $this->render($render);
        }

        return $render;
    }

    public function end(): string
    {
        if ($tag = array_pop($this->tags)) {
            return "</$tag>";
        }
        throw new RuntimeException('No tags to close');
    }

    public function isLivewire(string $component, bool $anonymous = false): bool
    {
        return ! $anonymous && is_subclass_of($component, LivewireComponent::class);
    }

    public function isBlade(string $component, bool $anonymous = false): bool
    {
        return $anonymous || is_subclass_of($component, BladeComponent::class);
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

    /**
     * @param  array<string,string>  $attributes
     */
    protected function stringifyAttributes(array $attributes): string
    {
        return collect($attributes)
            ->map(function (string $value, string $attribute): string {
                return "'{$attribute}' => {$value}";
            })
            ->implode(',');
    }
}
