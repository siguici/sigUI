@php
$attributes = $attributes->merge([...compact('type', 'name', 'id', 'value'), 'invalid' => $invalid || $errors->has($name), 'aria-invalid' => $invalid || $errors->has($name) ? 'true' : 'false']);
@endphp

@tag('input', $attributes)