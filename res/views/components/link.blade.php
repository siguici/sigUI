@php
$href = isset($route) ? route($route, $params) : url($href);
@endphp

@ui('a', $attributes->merge(compact('href')))
    @s('text', ['value' => $text], $slot)
@endui