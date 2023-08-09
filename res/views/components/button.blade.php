@isset($href)
    @tag('a', $attributes->merge(compact('href')))
        {{ $slot }}
        @isset($text)
        <s-text :value="$text"/>
        @endisset
    @endtag
@elseif(isset($text) || $slot->isNotEmpty())
    @tag('button', $attributes->merge(compact('type')))
        {{ $slot }}
        @isset($text)
        <s-text :value="$text"/>
        @endisset
    @endtag
@else
    @tag('input', $attributes->merge(compact('type', 'name', 'value')))
@endisset