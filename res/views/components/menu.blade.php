@ui($ordered ? 'ol' : 'ul', $attributes)
    @foreach ($list as $key => $value)
        @if (is_string($key) || is_array($value))
            @ui('li', $itemAttributes)
                <s-text :value="$key"/>
                <s-menu :list="(array)$value" :ordered="$ordered"/>
            @endui
        @else
            @ui('li', $itemAttributes, $value)
        @endif
    @endforeach
    {{ $slot }}
@endui