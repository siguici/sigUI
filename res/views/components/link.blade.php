@tag('a', $attributes->merge(compact('href')))
    @isset($text)
        <s-text :value="$text"/>
    @else
        {{ $slot }}
    @endisset
@endtag