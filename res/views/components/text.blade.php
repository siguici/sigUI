@php
$value = $value ?? $slot->toHtml();
$value = $translate ? __($value) : $value;
$value = $escape ? e($value) : $value;
@endphp

@isset($element)
@tag($element, $attributes, $value)
@else
{!! $value !!}
@endisset