@tag('label', $attributes)
    @isset($text)
        <s-text :value="$text"/>
    @else
        {{ $slot }}
    @endisset
@endtag