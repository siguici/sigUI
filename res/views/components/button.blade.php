@isset($href)
    @tag('a', $attributes->merge(compact('href')), $slot)
@else
    @tag('button', $attributes->merge(compact('type')), $slot)
@endisset