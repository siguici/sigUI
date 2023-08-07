@php
$attributes = $attributes->merge([...compact('name', 'id'), 'invalid' => $invalid || $errors->has($name), 'aria-invalid' => $invalid || $errors->has($name) ? 'true' : 'false']);
@endphp

@tag('textarea', $attributes, $value ?? $slot)