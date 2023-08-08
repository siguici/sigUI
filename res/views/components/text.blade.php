@php
$value = $value ?? $slot->toHtml();
$value = $translated ? $value : __($value);
$value = $escaped ? $value : e($value);
@endphp

@isset($element)
@tag($element, $attributes, $value)
@else
{!! $value !!}
@endisset