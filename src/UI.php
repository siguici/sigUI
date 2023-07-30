<?php

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\View\View as ViewContract;
use Sikessem\UI\UIManager;

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

if (! function_exists('ui')) {
    function ui(): UIManager
    {
        static $ui;

        if (! isset($ui)) {
            /** @var UIManager */
            $ui = app(UIManager::class);
        }

        return $ui;
    }
}

if (! \function_exists('render')) {
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
