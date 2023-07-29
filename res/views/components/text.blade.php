@php
$value = $value ?? $slot->toHtml();
$value = $translated ? $value : __($value);
@endphp

@if ($escaped) {!! $value !!} @else {{ $value }} @endif