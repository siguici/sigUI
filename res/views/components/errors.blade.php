@if ($errors->any())
    @tag($element, $attributes)
        @foreach ($errors->all() as $error)
            @tag($errorElement, $errorAttributes, $error)
        @endforeach
        {{ $slot }}
    @endtag
@endif