@if ($errors->any())
    @isset($icon)
    <s-icon :name="$icon"/>
    @endisset
@tag($tag, $attributes)
    @foreach ($errors->all() as $error)
    @tag($errorTag, [], $error)
    @endforeach
    {{ $slot }}
@endtag
@endif