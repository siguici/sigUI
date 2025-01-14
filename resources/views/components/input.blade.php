@php
$attributes = $attributes->merge([...compact('type', 'name', 'id', 'value'), 'checked' => in_array($type, ['checkbox', 'radio']) && $chosen, 'invalid' => $invalid || $errors->has($name), 'aria-invalid' => $invalid || $errors->has($name) ? 'true' : 'false']);
@endphp

@isset($icon)
<s-icon :name="$icon"/>
@endisset
@tag('input', $attributes)