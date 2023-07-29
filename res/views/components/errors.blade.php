@if ($errors->any())
    @ui($element, $attributes)
        @foreach ($errors->all() as $error)
            @ui($errorElement, $errorAttributes, $error)
        @endforeach
        {{ $slot }}
    @endui
@endif