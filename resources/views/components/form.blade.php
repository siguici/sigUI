@tag('form', $attributes->merge([...compact('action'), 'method' => $method === 'GET' ? $method : 'POST', 'enctype' => $hasFiles ? 'multipart/form-data' : false]))
    {{ $slot }}
    @method($method)
    @csrf
@endtag
