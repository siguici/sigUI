@php
$datalistId = empty($datalist) ? null : "$id-input-datalist";
$attributes = $attributes->merge([...compact('name', 'id', 'autocomplete'), 'list' => $datalistId, 'invalid' => $errors->has($name), 'aria-invalid' => $errors->has($name) ? 'true' : 'false']);
@endphp

@if ($type === 'textarea')
    @tag('textarea', $attributes, $value ?? $slot)
@else
    @tag('input', $attributes->merge(compact('type', 'value')))
@endif

@if ($datalist)
    @tag('datalist', ['id' => $datalistId])
        @foreach($datalist as $option)
            @tag('option', [], $option)
        @endforeach
    @endtag
@endif