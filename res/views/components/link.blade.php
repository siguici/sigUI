@php
$href = isset($route) ? route($route, $params) : url($href);
@endphp

@ui('a', $attributes->merge(['href' => $href]))
    @isset($text)
    <x-ui::text :value="$text"/>
    @else
    {{ $slot }}
    @endisset
@endui
