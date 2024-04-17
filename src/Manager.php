<?php

namespace Sikessem\UI;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag as ComponentAttributes;
use Illuminate\View\ComponentSlot;
use RuntimeException;
use Sikessem\UI\Contracts\IsComponentConfig;
use Sikessem\UI\Contracts\IsComponentTag;
use Sikessem\UI\Contracts\IsManager;

class Manager implements IsManager
{
    final public const COMPONENT_NAMESPACE = 'Sikessem\\UI\\Components';

    final public const ANONYMOUS_COMPONENT_NAMESPACE = 'ui::components';

    /**
     * @var array<string,array<string,array<IsComponentConfig>>>;
     */
    protected array $components = [];

    /**
     * @var array<ComponentTag>
     */
    protected array $tags = [];

    /**
     * @template TValue of mixed
     *
     * @param  TValue  $default
     * @return TValue
     */
    public function config(string $key, mixed $default = null): mixed
    {
        return config("sikessem.ui.$key", $default);
    }

    public function componentConfig(string $component, mixed $default = []): IsComponentConfig
    {
        return new ComponentConfig((array) $this->config("components.$component", $default));
    }

    /**
     * @template TValue of string
     *
     * @param  TValue  $default
     * @return TValue
     */
    public function getComponentTag(string $component, string $default = ''): string
    {
        if ($component = $this->find($component)) {
            ['options' => $options] = $component;

            return $options->getTag($default);
        }

        return $default;
    }

    /**
     * @template TValue of array<string,string>
     *
     * @param  TValue  $default
     * @return TValue
     */
    public function getComponentAttributes(string $component, array $default = []): array
    {
        if ($component = $this->find($component)) {
            ['options' => $options] = $component;

            return $options->getAttributes($default);
        }

        return $default;
    }

    /**
     * @template TValue of string
     *
     * @param  TValue  $default
     * @return TValue
     */
    public function getComponentContents(string $component, string $default = ''): string
    {
        if ($component = $this->find($component)) {
            ['options' => $options] = $component;

            return $options->getContents($default);
        }

        return $default;
    }

    /**
     * @template TValue of array<string,IsComponentConfig>
     *
     * @param  TValue  $default
     * @return TValue
     */
    public function getComponentVariants(string $component, array $default): array
    {
        if ($component = $this->find($component)) {
            ['options' => $options] = $component;

            return $options->getVariants($default);
        }

        return $default;
    }

    public function prefix(): string
    {
        return $this->config('prefix', 'ui');
    }

    public function component(string $class, ?string $alias = null, bool $anonymous = false): void
    {
        $alias ??= $anonymous ? $class : $this->getAlias($class);
        if (is_null($this->find($alias))) {
            $this->add($alias, $class, $this->componentConfig($alias), $anonymous);
        }
    }

    protected function add(string $alias, string $class, IsComponentConfig $options, bool $anonymous = false): void
    {
        $namespace = $anonymous ? self::ANONYMOUS_COMPONENT_NAMESPACE.'.' : self::COMPONENT_NAMESPACE.'\\';

        if (! str_starts_with($class, $namespace)) {
            $class = $namespace.$class;
        }

        $tag = $options->getTag();
        $contents = $options->getContents();
        $attributes = $options->getAttributes();
        $variants = $options->getVariants();
        $variants = collect($variants)->map(fn ($variant) => [
            'tag' => $variant->getTag($tag),
            'attributes' => (new ComponentAttributes($variant->getAttributes()))->merge($attributes)->getAttributes(),
            'contents' => $variant->getContents($contents),
            'variants' => $variant->getVariants(),
        ])->toArray();

        Blade::component($class, $alias, $this->prefix());

        $this->components[$namespace][$class][$alias] = new ComponentConfig(compact('tag', 'attributes', 'variants', 'contents'));

        foreach ($variants as $name => $variant) {
            $this->add("$name-$alias", $class, new ComponentConfig((array) $variant), $anonymous);
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

    public function getAlias(string $class, ?string $namespace = null): string
    {
        $namespace ??= self::COMPONENT_NAMESPACE;
        if (! str_ends_with($namespace, '\\')) {
            $namespace .= '\\';
        }

        if (str_starts_with($class, $namespace)) {
            $class = substr_replace($class, '', 0, strlen($namespace));
        }

        return Str::kebab(implode('', array_reverse(explode('\\', $class))));
    }

    /**
     * @return array{namespace:string,class:string,alias:string,options:IsComponentConfig}|null
     */
    public function find(string $component): ?array
    {
        foreach ($this->components as $namespace => $components) {
            foreach ($components as $class => $variants) {
                foreach ($variants as $alias => $options) {
                    if ($alias === $component) {
                        return compact('namespace', 'class', 'alias', 'options');
                    }
                }
            }
        }

        return null;
    }

    /**
     * @param  array<string,string>|ComponentAttributes  $attributes
     */
    public function make(string $name, array|ComponentAttributes $attributes = [], string|ComponentSlot|null $slot = null): string
    {
        if ($component = $this->find($name)) {
            ['alias' => $alias] = $component;

            $render = $this->makeComponentTag("x-ui-$alias", $attributes, $slot)->toHtml();
            $render = $this->render($render);

            return $render;
        }

        $options = $this->componentConfig($name);
        $attributes = $this->makeComponentAttributes($name, $attributes)->merge($options->getAttributes());

        return $this->makeComponentTag($options->getTag($name), $attributes, $slot ??= $options->getContents())->toHtml();
    }

    /**
     * @param  array<string,string>|ComponentAttributes  $attributes
     */
    public function openTag(string $name, array|ComponentAttributes $attributes = [], string|ComponentSlot|null $contents = null): string
    {
        $tag = $this->makeComponentTag($name, $attributes, $contents);

        if ($tag->isOrphan() || $tag->isNotEmpty()) {
            return $tag->toHtml();
        }

        array_push($this->tags, $tag);

        return $tag->open();
    }

    /**
     * @throws RuntimeException If there is no open tag
     */
    public function closeTag(): string
    {
        if ($tag = array_pop($this->tags)) {
            return $tag->close();
        }

        throw new RuntimeException('No tags open');
    }

    /**
     * @param  Arrayable<int|string,mixed>|mixed[]  $contentData
     * @param  Arrayable<int|string,mixed>|mixed[]  $layoutData
     */
    public function page(string $contentPath, Arrayable|array $contentData = [], ?string $layoutPath = null, Arrayable|array $layoutData = [], array $mergeData = []): ViewContract
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
    public function makeComponentTag(string $component, array|ComponentAttributes $attributes = [], string|ComponentSlot|null $contents = null): IsComponentTag
    {
        $tag = $this->getComponentTag($component, $component);

        $slot = $this->makeComponentSlot($component, $attributes, $contents);

        return ComponentTag::from($tag, $slot->attributes->getAttributes(), $slot->toHtml());
    }

    /**
     * @param  array<string,string>|ComponentAttributes  $attributes
     */
    public function makeComponentSlot(string $component, array|ComponentAttributes $attributes = [], string|ComponentSlot|null $contents = null): ComponentSlot
    {
        $attributes = $this->makeComponentAttributes($component, $attributes);

        /** @var string|ComponentSlot */
        $defaultContents = $this->getComponentContents($component, '');
        $contents ??= $defaultContents;
        if ($contents instanceof ComponentSlot) {
            $contents = $contents->toHtml();
        }

        return new ComponentSlot($contents, $attributes->getAttributes());
    }

    /**
     * @param  array<string,string>|ComponentAttributes  $attributes
     */
    public function makeComponentAttributes(string $component, array|ComponentAttributes $attributes = []): ComponentAttributes
    {
        if (! $attributes instanceof ComponentAttributes) {

            $attributes = new ComponentAttributes($attributes);
        }

        return $attributes->merge((array) $this->getComponentAttributes($component, []));
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
            ->map(fn (string $value, string $key): string => "'{$key}' => {$value}")
            ->implode(',');
        $array = "[$array]";

        return $array;
    }
}
