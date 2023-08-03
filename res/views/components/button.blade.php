@isset($href)
    @tag('a', $attributes->merge(compact('href')))
        @isset($text)
            <s-text :value="$text"/>
        @else
            {{ $slot }}
        @endisset
    @endtag
@elseif(isset($text) || $slot->isNotEmpty())
    @tag('button', $attributes->merge(compact('type')))
        @isset($text)
            <s-text :value="$text"/>
        @else
            {{ $slot }}
        @endisset
    @endtag
@else
    @tag('input', $attributes->merge(compact('type', 'name', 'value')))
@endisset