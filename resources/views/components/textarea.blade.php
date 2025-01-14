@php
$attributes = $attributes->merge([...compact('name', 'id'), 'invalid' => $invalid || $errors->has($name), 'aria-invalid' => $invalid || $errors->has($name) ? 'true' : 'false']);
@endphp

@isset($icon)
<s-icon :name="$icon"/>
@endisset

@tag('textarea', $attributes)
{{ $value ?? $slot }}
@endtag