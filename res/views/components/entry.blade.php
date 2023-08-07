@php
$datalistId = empty($datalist) ? null : "$id-input-datalist";
$attributes = $attributes->merge([...compact('name', 'id', 'autocomplete'), 'list' => $datalistId]);
@endphp

@if ($type === 'textarea')
<s-textarea {{ $attributes }}>{{ $slot }}</s-textarea>
@else
<s-input {{ $attributes->merge(compact('type')) }}/>
@endif

@if ($datalistId)
@tag('datalist', ['id' => $datalistId])
    @foreach($datalist as $option)
    @tag('option', [], $option)
    @endforeach
@endtag
@endif