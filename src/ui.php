<?php

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\View\View as ViewContract;
use Sikessem\UI\Contracts\IsManager;
use Sikessem\UI\Manager;

if (! function_exists('sikessem_ui_path')) {
    function sikessem_ui_path(string $path = null): string
    {
        $path = dirname(__DIR__).DIRECTORY_SEPARATOR.($path ?: '');

        if (file_exists($path)) {
            $path = realpath($path) ?: $path;
        }

        return $path;
    }
}

if (! function_exists('sikessem_config_path')) {
    function sikessem_config_path(string $path = null): string
    {
        $path = config_path(rtrim('sikessem/'.($path ?: ''), '/'));

        return realpath($path) ?: $path;
    }
}

if (! function_exists('sikessem_lang_path')) {
    function sikessem_lang_path(string $path = null): string
    {
        $path = lang_path(rtrim('sikessem/'.($path ?: ''), '/'));

        return realpath($path) ?: $path;
    }
}

if (! function_exists('sikessem_resource_path')) {
    function sikessem_resource_path(string $path = null): string
    {
        $path = resource_path(rtrim('views/vendor/sikessem/'.($path ?: ''), '/'));

        return realpath($path) ?: $path;
    }
}

if (! function_exists('ui')) {
    function ui(): IsManager
    {
        static $ui;

        if (! isset($ui)) {
            /** @var IsManager */
            $ui = app(Manager::class);
        }

        return $ui;
    }
}

if (! function_exists('render')) {
    /**
     * @param  mixed[]  $data
     */
    function render(string $template, array $data = [], bool $deleteCachedView = false): string
    {
        return ui()->render($template, $data, $deleteCachedView);
    }
}

if (! function_exists('page')) {
    /**
     * @param  Arrayable<int|string,mixed>|mixed[]  $contentData
     * @param  Arrayable<int|string,mixed>|mixed[]  $layoutData
     */
    function page(string $contentPath, Arrayable|array $contentData = [], string $layoutPath = null, Arrayable|array $layoutData = [], array $mergeData = []): ViewContract
    {
        return ui()->page($contentPath, $contentData, $layoutPath, $layoutData, $mergeData);
    }
}
