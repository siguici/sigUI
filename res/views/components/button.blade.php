@php
$type = strtolower($type);
$href = isset($route) ? route($route, $params) : ($href ? url($href) : null);
@endphp

@isset($href)
    @ui('a', $attributes->merge(compact('href')), $slot)
@else
    @ui('button', $attributes->merge(compact('type')), $slot)
@endisset