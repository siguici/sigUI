@if ($messages->isNotEmpty())
    @tag($element, $attributes)
        @foreach($messages as $message)
            @tag($flashElement, $flashAttributes, $message)
        @endforeach
    @endtag
@endif