@php
$type = strtolower($type);
$href = isset($route) ? route($route, $params) : ($href ? url($href) : null);
@endphp

@isset($href)
    @tag('a', $attributes->merge(compact('href')), $slot)
@else
    @tag('button', $attributes->merge(compact('type')), $slot)
@endisset