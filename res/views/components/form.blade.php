@ui('form', $attributes->merge(['method' => $method === 'GET' ? $method : 'POST', 'action' => $action, 'enctype' => $hasFiles ? 'multipart/form-data' : false]))
    @csrf
    @if ($method !== 'GET' && $method !== 'POST')
        @method($method)
    @endif
    {{ $slot }}
@endui