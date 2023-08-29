@php
$datalistId = empty($datalist) ? null : "$id-input-datalist";
$attributes = $attributes->merge([...compact('name', 'id', 'autocomplete'), 'list' => $datalistId]);
@endphp

@if ($type === 'textarea')
<s-textarea {{ $attributes->merge(compact('icon')) }}>{{ $slot }}</s-textarea>
@else
<s-input {{ $attributes->merge(compact('type', 'icon')) }}/>
@endif

@if ($datalistId)
    @tag('datalist', ['id' => $datalistId])
        @foreach($datalist as $option)
        @tag('option', [], $option)
        @endforeach
    @endtag
@endif