@php
$href = isset($route) ? route($route, $params) : url($href);
@endphp

@tag('a', $attributes->merge(compact('href')))
    <s-text :value="$text">
        {{ $slot }}
    </s-text>
@endtag