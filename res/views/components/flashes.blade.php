@if ($messages->isNotEmpty())
    @ui($element, $attributes)
        @foreach($messages as $message)
            @ui($flashElement, $flashAttributes, $message)
        @endforeach
    @endui
@endif