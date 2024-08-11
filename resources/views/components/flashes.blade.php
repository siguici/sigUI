@if ($messages->isNotEmpty())
    @isset($icon)
    <s-icon :name="$icon"/>
    @endisset
    @tag($tag, $attributes)
        @foreach($messages as $message)
        @tag($flashTag, [], $message)
        @endforeach
    @endtag
@endif