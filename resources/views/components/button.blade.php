@isset($href)
    @tag('a', $attributes->merge(compact('href')))
        @isset($icon)
        <s-icon :name="$icon"/>
        @endisset
        @isset($text)
        <s-text :value="$text"/>
        @endisset
        {{ $slot }}
    @endtag
@elseif(isset($text) || $slot->isNotEmpty())
    @tag('button', $attributes->merge(compact('type')))
        @isset($icon)
        <s-icon :name="$icon"/>
        @endisset
        @isset($text)
        <s-text :value="$text"/>
        @endisset
        {{ $slot }}
    @endtag
@else
    @tag('input', $attributes->merge(compact('type', 'name', 'value')))
@endisset