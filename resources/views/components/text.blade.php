@php
$value = $value ?? $slot->toHtml();
$value = $translate ? __($value) : $value;
$value = $escape ? e($value) : $value;
@endphp

@isset($tag)
    @tag($tag, $attributes, $value)
@else
{!! $value !!}
@endisset