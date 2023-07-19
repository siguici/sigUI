@php
$href = isset($route) ? route($route, $params) : url($href);
@endphp

<a href="{{ $href }}" {{ $attributes }}>
    @isset($text)
    <x-ui::text :value="$text"/>
    @else
    {{ $slot }}
    @endisset
</a>