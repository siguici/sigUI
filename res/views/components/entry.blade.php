@php
$attributes = $attributes->merge([...compact('name', 'id', 'autocomplete'), 'invalid' => $errors->has($name), 'aria-invalid' => $errors->has($name) ? 'true' : 'false']);
@endphp

@if ($type === 'textarea')
    @tag('textarea', $attributes, $value ?? $slot)
@else
    @tag('input', $attributes->merge(compact('type', 'value')))
@endif
