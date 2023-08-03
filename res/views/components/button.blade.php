@isset($href)
    @tag('a', $attributes->merge(compact('href')))
        <s-text :value="$text">{{ $slot }}</s-text>
    @endtag
@elseif(isset($text) || $slot->isNotEmpty())
    @tag('button', $attributes->merge(compact('type')))
        <s-text :value="$text">{{ $slot }}</s-text>
    @endtag
@else
    @tag('input', $attributes->merge(compact('type', 'name', 'value')))
@endisset