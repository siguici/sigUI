@tag($ordered ? 'ol' : 'ul', $attributes)
    @foreach ($list as $key => $value)
        @if (is_string($key) || is_array($value))
            @tag('li', $itemAttributes)
            <s-text :value="$key"/>
            <s-menu :list="(array)$value" :ordered="$ordered"/>
            @endtag
        @else
            @tag('li', $itemAttributes, $value)
        @endif
    @endforeach
    {{ $slot }}
@endtag