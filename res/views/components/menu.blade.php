@ui($ordered ? 'ol' : 'ul', $attributes)
    @foreach ($list as $key => $value)
        @if (is_string($key) || is_array($value))
            @ui('li', $itemAttributes)
                <x-ui::text :value="$key"/>
                <x-ui::menu :list="(array)$value" :ordered="$ordered"/>
            @endui
        @else
            @ui('li', $itemAttributes)
                {{ $value }}
            @endui
        @endif
    @endforeach
    {{ $slot }}
@endui