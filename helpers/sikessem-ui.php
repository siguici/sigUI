<?php

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\View\View as ViewContract;
use Sikessem\UI\Core\Manager;

if (! function_exists('sikessem_ui_path')) {
    function sikessem_ui_path(string $path = null): string
    {
        $path = dirname(__DIR__).DIRECTORY_SEPARATOR.($path ?: '');

        if (file_exists($path)) {
            $path = realpath($path);
        }

        return $path;
    }
}

if (! function_exists('ui')) {
    function ui(): Manager
    {
        return app()->make(Manager::class);
    }
}

if (! \function_exists('render')) {
    function render(string $content, array $data = [], bool $deleteCachedView = false): string
    {
        return ui()->render($content, $data, $deleteCachedView);
    }
}

if (! function_exists('page')) {
    function page(string $content, Arrayable|array $data = [], string $layout = null, Arrayable|array $layoutData = [], array $mergeData = []): ViewContract
    {
        return ui()->page($content, $data, $layout, $layoutData, $mergeData);
    }
}
