@tag('form', $attributes->merge([...compact('method', 'action'), 'enctype' => $hasFiles ? 'multipart/form-data' : false]))
    @csrf
    @method($method)
    {{ $slot }}
@endtag