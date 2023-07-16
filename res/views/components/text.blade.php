@php
$value = $value ?: $slot->toHtml();
@endphp

@isset($tag)<{{ $tag }} {{ $attributes }}>@endisset
@if($escape){{ $translate ? __($value) : $value }}@else{!! $translate ? __($value) : $value !!}@endif
@isset($tag)</{{ $tag }}>@endisset