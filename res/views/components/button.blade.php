@php
$type = strtolower($type);
$href = isset($route) ? route($route, $params) : ($href ? url($href) : null);
@endphp

@isset($href)<a href="{{ $href }}" {{ $attributes }}>{{ $slot }}</a>
@else<button type="{{ $type }}" {{ $attributes }}>{{ $slot }}</button>
@endisset