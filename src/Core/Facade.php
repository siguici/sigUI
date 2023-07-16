<?php

namespace Sikessem\UI\Core;

use Illuminate\Support\Facades\Facade as BaseFacade;

/**
 * @method static void component(string $class, string $alias = null, bool $anonymous = false)
 * @method static bool isBlade(string $component, bool $anonymous = false)
 * @method static bool isLivewire(string $component, bool $anonymous = false)
 * @method static string renderComponent(string $content, array $data = [], bool $deleteCachedView = true)
 * @method static \Illuminate\Contracts\View\View renderPage(string $content, string $layout = null, \Illuminate\Contracts\Support\Arrayable|array $contentData = [], \Illuminate\Contracts\Support\Arrayable|array $layoutData = [], array $mergeData = [])
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
