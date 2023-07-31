@tag('a', $attributes->merge(compact('href')))
    <s-text :value="$text">
        {{ $slot }}
    </s-text>
@endtag