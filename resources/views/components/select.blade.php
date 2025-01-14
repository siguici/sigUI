@php
$attributes = $attributes->merge([...compact('name', 'id'), 'invalid' => $invalid || $errors->has($name), 'aria-invalid' => $invalid || $errors->has($name) ? 'true' : 'false']);
@endphp

@isset($icon)
<s-icon :name="$icon"/>
@endisset
@tag('select', $attributes)
    @foreach($options as $label => $option)
        @if (is_array($option))
        @tag('optgroup', compact('label'))
            @foreach($option as $key => $item)
            @tag('option', ['value' => $key, 'selected' => isset($value) && ($value == $key || $value === $item)], $item)
            @endforeach
        @endtag
        @else
            @tag('option', ['value' => $label, 'selected' => isset($value) && ($value == $label || $value === $option)], $option)
        @endif
    @endforeach
    {{ $slot }}
@endtag