@php
$value = $value ?: $slot->toHtml();
@endphp

@if($escape){{ $translate ? __($value) : $value }}@else{!! $translate ? __($value) : $value !!}@endif
