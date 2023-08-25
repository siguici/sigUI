@if ($messages->isNotEmpty())
@tag($tag, $attributes)
    @foreach($messages as $message)
    @tag($flashTag, [], $message)
    @endforeach
@endtag
@endif