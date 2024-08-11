@tag('label', $attributes)
    @isset($icon)
    <s-icon :name="$icon"/>
    @endisset
    @isset($text)
    <s-text :value="$text"/>
    @endisset
    {{ $slot }}
@endtag