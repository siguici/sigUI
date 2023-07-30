<?php

namespace Sikessem\UI;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag as ComponentAttributes;
use Illuminate\View\ComponentSlot;
use Livewire\Livewire;
use RuntimeException;
use Sikessem\UI\Common\BladeComponent;
use Sikessem\UI\Common\LivewireComponent;

class UIManager
{
    public const COMPONENT_NAMESPACE = 'Sikessem\\UI\\Components';

    public const ANONYMOUS_COMPONENT_NAMESPACE = 'ui::components';

    protected const TAGS = [
        'orphan' => [
            'area',
            'base',
            'basefont',
            'br',
            'col',
            'command',
            'embed',
            'frame',
            'hr',
            'img',
            'input',
            'isindex',
            'keygen',
            'link',
            'meta',
            'param',
            'source',
            'track',
            'wbr',
        ],
        'inline' => [
            'a',
            'abbr',
            'acronym',
            'b',
            'bdi',
            'bdo',
            'big',
            'br',
            'cite',
            'code',
            'data',
            'del',
            'dfn',
            'em',
            'font',
            'i',
            'img',
            'ins',
            'kbd',
            'map',
            'mark',
            'object',
            'q',
            'rp',
            'rt',
            'rtc',
            'ruby',
            's',
            'samp',
            'small',
            'span',
            'strike',
            'strong',
            'sub',
            'sup',
            'time',
            'tt',
            'u',
            'var',
        ],
    ];

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
            $class = ($anonymous ? self::ANONYMOUS_COMPONENT_NAMESPACE.'.' : self::COMPONENT_NAMESPACE.'\\').$class;
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
     * @param  array<string,string>|ComponentAttributes  $attributes
     */
    public function make(string $name, array|ComponentAttributes $attributes = [], string|ComponentSlot $slot = null): string
    {
        if ($component = $this->find($name)) {
            ['class' => $class, 'alias' => $alias] = $component;
            $slot = $this->makeComponentSlot($name, $attributes, $slot);

            $render = '';

            if ($this->isLivewire($class)) {
                $render .= $slot->isEmpty()
                ? '<livewire:ui-'.$alias.' '.$slot->attributes->toHtml().'>'
                : "@livewire('ui-$alias', ".$this->attributesToString($slot->attributes).", key({$slot->toHtml()}))";
            } else {
                $render .= "<x-ui-$alias {$this->attributesToHtml($slot->attributes)}";
                $render .= $slot->isEmpty() ? '/>' : "</x-ui-$alias>";
            }

            $render = $this->render($render);

            return $render;
        }

        return $this->openTag($name, $attributes, $slot);
    }

    /**
     * @param  array<string,string>|ComponentAttributes  $attributes
     */
    public function openTag(string $name, array|ComponentAttributes $attributes = [], string|ComponentSlot $slot = null): string
    {
        $slot = $this->makeComponentSlot($name, $attributes, $slot);

        /** @var string */
        $name = config("ui.$name.element", $name);

        $render = "<{$name} {$this->attributesToHtml($slot->attributes)}";

        if ($this->isOrphan($name)) {
            return $render .= '/>';
        }

        $render .= '>';

        array_push($this->tags, $name);

        if (! $slot->isEmpty()) {
            $render .= $slot->toHtml();
            $render .= $this->closeTag();
        }

        return $render;
    }

    /**
     * @throws RuntimeException If there is no open tag
     */
    public function closeTag(): string
    {
        if ($tag = array_pop($this->tags)) {
            return "</$tag>";
        }

        throw new RuntimeException('No tags open');
    }

    public function isLivewire(string $component, bool $anonymous = false): bool
    {
        return ! $anonymous && is_subclass_of($component, LivewireComponent::class);
    }

    public function isBlade(string $component, bool $anonymous = false): bool
    {
        return $anonymous || is_subclass_of($component, BladeComponent::class);
    }

    public function isOrphan(string $tag): bool
    {
        return in_array($tag, self::TAGS['orphan']);
    }

    public function isPaired(string $tag): bool
    {
        return ! $this->isOrphan($tag);
    }

    public function isInline(string $tag): bool
    {
        return in_array($tag, self::TAGS['inline']);
    }

    public function isBlock(string $tag): bool
    {
        return ! $this->isInline($tag);
    }

    /**
     * @param  Arrayable<int|string,mixed>|mixed[]  $contentData
     * @param  Arrayable<int|string,mixed>|mixed[]  $layoutData
     */
    public function page(string $contentPath, Arrayable|array $contentData = [], string $layoutPath = null, Arrayable|array $layoutData = [], array $mergeData = []): ViewContract
    {
        if (isset($layoutPath)) {
            $content = ViewFacade::make("contents.$contentPath", $contentData, $mergeData)->render();

            return ViewFacade::make("layouts.$layoutPath", compact('content') + $layoutData, array_merge($contentData instanceof Arrayable ? $contentData->toArray() : $contentData, $mergeData));
        }

        return ViewFacade::make("pages.$contentPath", $contentData, $mergeData);
    }

    /**
     * @param  mixed[]  $data
     */
    public function render(string $template, array $data = [], bool $deleteCachedView = false): string
    {
        $render = Blade::render($template, $data, $deleteCachedView);
        if (! config('app.debug')) {
            $render = $this->compress($render);
        }

        return $render;
    }

    public function compress(string $code): string
    {
        $code = preg_replace([
            '/(?:\v|\t|\s)+/m',
            '/[\s ]*\</s',
            '/[\s ]*(\/?\>)[\s ]*/s',
            '/=\s+(\"|\')/',
            '/(\"|\')\s+(\/?\>)/s',
            '/<!--.*?-->/s',
        ], [
            ' ',
            '<',
            '$1',
            '=$1',
            '$1$2',
            '',
        ], $code) ?: $code;

        $code = trim($code);

        return $code;
    }

    /**
     * @param  array<string,string>|ComponentAttributes  $attributes
     */
    protected function makeComponentSlot(string $name = null, array|ComponentAttributes $attributes = [], string|ComponentSlot $slot = null): ComponentSlot
    {
        $attributes = $this->makeComponentAttributes($name, $attributes);
        /** @var string|ComponentSlot */
        $defaultSlot = config("ui.$name.slot", '');
        $slot ??= $defaultSlot;
        if ($slot instanceof ComponentSlot) {
            $slot = $slot->toHtml();
        }

        return new ComponentSlot($slot, $attributes->getAttributes());
    }

    /**
     * @param  array<string,string>|ComponentAttributes  $attributes
     */
    protected function makeComponentAttributes(string $name = null, array|ComponentAttributes $attributes = []): ComponentAttributes
    {
        if (! $attributes instanceof ComponentAttributes) {

            $attributes = new ComponentAttributes($attributes);
        }

        return $attributes->merge((array) config("ui.$name.attributes", []));
    }

    protected function attributesToString(ComponentAttributes $attributes): string
    {
        return $this->toArrayString($attributes->getAttributes());
    }

    protected function attributesToHtml(ComponentAttributes $attributes): string
    {
        return $attributes->toHtml();
    }

    protected function toHtmlString(mixed $value): string
    {
        return var_export($value, true);
    }

    /**
     * @param  Arrayable<string,string>|iterable<string,string>  $array
     */
    protected function toArrayString(Arrayable|iterable $array): string
    {
        $array = collect($array)
            ->map(function (string $value, string $key): string {
                return "'{$key}' => {$value}";
            })
            ->implode(',');
        $array = "[$array]";

        return $array;
    }
}
