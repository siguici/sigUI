@error($field, $stack)
    @isset($icon)
    <s-icon :name="$icon"/>
    @endisset
@tag($tag, $attributes, $slot->isEmpty() ? $message : $slot)
@enderror