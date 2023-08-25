<?php

namespace Sikessem\UI;

use Illuminate\Support\Facades\Facade as BaseFacade;

/**
 * @method static string closeTag()
 * @method static void component(string $class, string $alias = null, bool $anonymous = false)
 * @method static \Sikessem\UI\IsComponentConfig componentConfig(string $component, mixed $default = [])
 * @method static string compress(string $contents)
 * @method static mixed config(string $key, mixed $default)
 * @method static array|null find(string $name)
 * @method static bool isBlock(string $tag)
 * @method static bool isInline(string $tag)
 * @method static bool isOrphan(string $tag)
 * @method static bool isPaired(string $tag)
 * @method static string getAlias(string $class, string $namespace = null)
 * @method static string getComponentTag(string $component, string $default = '')
 * @method static array getComponentAttributes(string $component, array $default = [])
 * @method static string getComponentContents(string $component, string $default = '')
 * @method static array getComponentVariants(string $component, array $default)
 * @method static string make(string $name, array|\Illuminate\View\ComponentAttributeBag $attributes = [], string|\Illuminate\View\ComponentSlot $slot = null)
 * @method static \Sikessem\UI\Contracts\IsComponentTag makeComponentTag(string $component, array|\Illuminate\View\ComponentAttributeBag $attributes = [], string|\Illuminate\View\ComponentSlot $contents = null)
 * @method static \Illuminate\View\ComponentSlot makeComponentSlot(string $component, array|\Illuminate\View\ComponentAttributeBag $attributes = [], string|\Illuminate\View\ComponentSlot $contents = null)
 * @method static \Illuminate\View\ComponentAttributeBag makeComponentAttributes(string $component, array|\Illuminate\View\ComponentAttributeBag $attributes = [])
 * @method static string prefix()
 * @method static string openTag(string $name, array|\Illuminate\View\ComponentAttributeBag $attributes = [], string|\Illuminate\View\ComponentSlot $slot = null)
 * @method static string prefix()
 * @method static string render(string $template, array $data = [], bool $deleteCachedView = true)
 * @method static \Illuminate\Contracts\View\View page(string $contentPath, \Illuminate\Contracts\Support\Arrayable|array $contentData = [], string $layoutPath = null, \Illuminate\Contracts\Support\Arrayable|array $layoutData = [], array $mergeData = [])
 *
 * @see \Sikessem\UI\Manager
 */
class Facade extends BaseFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sikessem.ui';
    }
}
