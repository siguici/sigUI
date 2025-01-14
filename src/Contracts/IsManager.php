<?php

namespace Sigui\UI\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\View\ComponentAttributeBag as ComponentAttributes;
use Illuminate\View\ComponentSlot;
use RuntimeException;

interface IsManager
{
    public const COMPONENT_NAMESPACE = 'Sigui\\UI\\Components';

    public const ANONYMOUS_COMPONENT_NAMESPACE = 'ui::components';

    /**
     * @template TValue of mixed
     *
     * @param  TValue  $default
     * @return TValue
     */
    public function config(string $key, mixed $default = null): mixed;

    public function componentConfig(string $component, mixed $default = []): IsComponentConfig;

    /**
     * @template TValue of string
     *
     * @param  TValue  $default
     * @return TValue
     */
    public function getComponentTag(string $component, string $default = ''): string;

    /**
     * @template TValue of array<string,string>
     *
     * @param  TValue  $default
     * @return TValue
     */
    public function getComponentAttributes(string $component, array $default = []): array;

    /**
     * @template TValue of string
     *
     * @param  TValue  $default
     * @return TValue
     */
    public function getComponentContents(string $component, string $default = ''): string;

    /**
     * @template TValue of array<string,IsComponentConfig>
     *
     * @param  TValue  $default
     * @return TValue
     */
    public function getComponentVariants(string $component, array $default): array;

    public function prefix(): string;

    public function component(string $class, ?string $alias = null, bool $anonymous = false): void;

    /**
     * @param  array<string>  $classes
     */
    public function components(array $classes = [], bool $anonymous = false): void;

    public function getAlias(string $class, ?string $namespace = null): string;

    /**
     * @return array{namespace:string,class:string,alias:string,options:IsComponentConfig}|null
     */
    public function find(string $component): ?array;

    /**
     * @param  array<string,string>|ComponentAttributes  $attributes
     */
    public function make(string $name, array|ComponentAttributes $attributes = [], string|ComponentSlot|null $slot = null): string;

    /**
     * @param  array<string,string>|ComponentAttributes  $attributes
     */
    public function openTag(string $name, array|ComponentAttributes $attributes = [], string|ComponentSlot|null $contents = null): string;

    /**
     * @throws RuntimeException If there is no open tag
     */
    public function closeTag(): string;

    /**
     * @param  Arrayable<int|string,mixed>|mixed[]  $contentData
     * @param  Arrayable<int|string,mixed>|mixed[]  $layoutData
     */
    public function page(string $contentPath, Arrayable|array $contentData = [], ?string $layoutPath = null, Arrayable|array $layoutData = [], array $mergeData = []): ViewContract;

    /**
     * @param  mixed[]  $data
     */
    public function render(string $template, array $data = [], bool $deleteCachedView = false): string;

    public function compress(string $code): string;

    /**
     * @param  array<string,string>|ComponentAttributes  $attributes
     */
    public function makeComponentTag(string $component, array|ComponentAttributes $attributes = [], string|ComponentSlot|null $contents = null): IsComponentTag;

    /**
     * @param  array<string,string>|ComponentAttributes  $attributes
     */
    public function makeComponentSlot(string $component, array|ComponentAttributes $attributes = [], string|ComponentSlot|null $contents = null): ComponentSlot;

    /**
     * @param  array<string,string>|ComponentAttributes  $attributes
     */
    public function makeComponentAttributes(string $component, array|ComponentAttributes $attributes = []): ComponentAttributes;
}
