@php
$attributes = $attributes->merge([...compact('name', 'id'), 'invalid' => $invalid || $errors->has($name), 'aria-invalid' => $invalid || $errors->has($name) ? 'true' : 'false']);
@endphp

@tag('select', $attributes)
    @foreach($options as $label => $option)
    @if (is_array($option))
    @tag('optgroup', compact('label'))
        @foreach($option as $key => $item)
        @tag('option', ['value' => is_int($key) ? null : $key, 'selected' => isset($value) && $value === $key], $item)
        @endforeach
    @endtag
    @else
    @tag('option', ['value' => is_int($label) ? null : $label, 'selected' => isset($value) && $label], $option)
    @endif
    @endforeach
    {{ $slot }}
@endtag