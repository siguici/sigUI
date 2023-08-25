@if ($errors->any())
@tag($tag, $attributes)
    @foreach ($errors->all() as $error)
    @tag($errorTag, [], $error)
    @endforeach
    {{ $slot }}
@endtag
@endif