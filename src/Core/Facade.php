<?php

namespace Sikessem\UI\Core;

use Illuminate\Support\Facades\Facade as BaseFacade;

/**
 * @method static void component(string $class, string $alias = null, bool $anonymous = false)
 * @method static string compress(string $contents)
 * @method static string close()
 * @method static array|null find(string $name)
 * @method static bool isBlade(string $component, bool $anonymous = false)
 * @method static bool isBlock(string $tag)
 * @method static bool isInline(string $tag)
 * @method static bool isLivewire(string $component, bool $anonymous = false)
 * @method static bool isOrphan(string $tag)
 * @method static bool isPaired(string $tag)
 * @method static string make(string $name, array|\Illuminate\View\ComponentAttributeBag $attributes = [], string|\Illuminate\View\ComponentSlot $slot = null)
 * @method static string open(string $name, array|ComponentAttributes $attributes = [], string|ComponentSlot $slot = null)
 * @method static string render(string $template, array $data = [], bool $deleteCachedView = true)
 * @method static \Illuminate\Contracts\View\View page(string $contentPath, \Illuminate\Contracts\Support\Arrayable|array $contentData = [], string $layoutPath = null, \Illuminate\Contracts\Support\Arrayable|array $layoutData = [], array $mergeData = [])
 *
 * @see \Sikessem\UI\Core\Manager
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
