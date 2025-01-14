<?php

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\View\View as ViewContract;
use Sigui\UI\Contracts\IsManager;
use Sigui\UI\Manager;

if (! function_exists('sigui_ui_path')) {
    function sigui_ui_path(?string $path = null): string
    {
        $path = dirname(__DIR__).DIRECTORY_SEPARATOR.($path ?: '');

        if (file_exists($path)) {
            $path = realpath($path) ?: $path;
        }

        return $path;
    }
}

if (! function_exists('sigui_config_path')) {
    function sigui_config_path(?string $path = null): string
    {
        $path = config_path(rtrim('sigui/'.($path ?: ''), '/'));

        return realpath($path) ?: $path;
    }
}

if (! function_exists('sigui_lang_path')) {
    function sigui_lang_path(?string $path = null): string
    {
        $path = lang_path(rtrim('sigui/'.($path ?: ''), '/'));

        return realpath($path) ?: $path;
    }
}

if (! function_exists('sigui_resource_path')) {
    function sigui_resource_path(?string $path = null): string
    {
        $path = resource_path(rtrim('views/vendor/sigui/'.($path ?: ''), '/'));

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
    function page(string $contentPath, Arrayable|array $contentData = [], ?string $layoutPath = null, Arrayable|array $layoutData = [], array $mergeData = []): ViewContract
    {
        return ui()->page($contentPath, $contentData, $layoutPath, $layoutData, $mergeData);
    }
}
