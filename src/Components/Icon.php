<?php

namespace Sikessem\UI\Components;

use Illuminate\Support\Str;
use RuntimeException;
use Sikessem\UI\Component;
use Sikessem\UI\Facade;

class Icon extends Component
{
    public string $tag;

    public string $contents;

    public string $name;

    public string $url;

    public int $width;

    public int $height;

    public function __construct(
        string $name,
        string $root = null,
        int $size = 24,
        string $type = 'solid',
        string $tag = 'svg',
        int $width = 24,
        int $height = 24,
        string $fill = 'currentColor',
    ) {
        $name = Str::squish($name);
        $name = Str::kebab($name);

        $root ??= sikessem_ui_path('res/icons');

        if (! \is_file($icon = "$root/$size/$type/$name.svg")) {
            throw new RuntimeException("No icon named $name was found for type $type of size $size.");
        }

        $name = Str::camel($name);
        $name = Str::snake($name, ' ');

        $icon = file_get_contents($icon) or throw new RuntimeException("Cannot read $icon file");
        $icon = str_replace(
            '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 '.$size.' '.$size.'" fill="none" xmlns="http://www.w3.org/2000/svg">',
            '<svg width="'.$width.'" height="'.$height.'" viewBox="0 0 '.$width.' '.$height.'" fill="none" xmlns="http://www.w3.org/2000/svg">',
            $icon,
        );
        $icon = preg_replace('/fill="[^"]+?"/', 'fill="'.$fill.'"', $icon) ?: $icon;
        $icon = Facade::render($icon);
        $url = 'data:image/svg+xml;base64,'.base64_encode($icon);

        $contents = str_replace(
            '<svg width="'.$width.'" height="'.$height.'" viewBox="0 0 '.$width.' '.$height.'" fill="'.$fill.'" xmlns="http://www.w3.org/2000/svg">',
            '',
            $icon,
        );
        $contents = str_replace('</svg>', '', $contents);

        $this->name = $name;
        $this->url = $url;
        $this->tag = strtolower($tag);
        $this->contents = trim($contents);
        $this->width = $width;
        $this->height = $height;
    }
}
