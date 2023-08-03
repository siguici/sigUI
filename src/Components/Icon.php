<?php

namespace Sikessem\UI\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use RuntimeException;
use Sikessem\UI\Common\BladeComponent;
use Sikessem\UI\UIFacade;

class Icon extends BladeComponent
{
    public string $name;

    public string $url;

    public string $element;

    public string $content;

    public int $width;

    public int $height;

    public function __construct(
        string $name,
        int $size = 24,
        string $type = 'solid',
        string $element = null,
        int $width = null,
        int $height = null,
        string $fill = null,
    ) {
        $name = Str::snake($name, '-');

        if (! file_exists($icon = sikessem_ui_path("res/icons/$size/$type/$name.svg"))) {
            throw new RuntimeException("No icon named $name was found for type $type of size $size.");
        }

        /** @var string $defaultElement */
        $defaultElement = config('ui.icon.element', 'svg');
        /** @var int $defaultWidth */
        $defaultWidth = config('ui.icon.width', $size);
        /** @var int $defaultHeight */
        $defaultHeight = config('ui.icon.height', $size);
        /** @var int $defaultFill */
        $defaultFill = config('ui.icon.fill', 'currentColor');

        $element ??= $defaultElement;
        $width ??= $defaultWidth;
        $height ??= $defaultHeight;
        $fill ??= $defaultFill;

        $icon = file_get_contents($icon) or throw new RuntimeException("Cannot read $icon file");
        $icon = str_replace(
            '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" fill="none" xmlns="http://www.w3.org/2000/svg">',
            '<svg width="'.$width.'" height="'.$height.'" viewBox="0 0 '.$width.' '.$height.'" fill="none" xmlns="http://www.w3.org/2000/svg">',
            $icon,
        );
        $icon = preg_replace('/fill="[^"]+?"/', 'fill="'.$fill.'"', $icon) ?: $icon;
        $icon = UIFacade::render($icon);
        $url = 'data:image/svg+xml;base64,'.base64_encode($icon);

        $content = str_replace(
            '<svg width="'.$width.'" height="'.$height.'" viewBox="0 0 '.$width.' '.$height.'" fill="'.$fill.'" xmlns="http://www.w3.org/2000/svg">',
            '',
            $icon,
        );
        $content = str_replace('</svg>', '', $content);

        $this->name = $name;
        $this->url = $url;
        $this->element = strtolower($element);
        $this->content = trim($content);
        $this->width = $width;
        $this->height = $height;
    }

    public function render(): View|Factory
    {
        return view('ui::components.icon');
    }
}
