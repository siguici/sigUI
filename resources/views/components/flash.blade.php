@if ($message)
    @isset($icon)
    <s-icon :name="$icon"/>
    @endisset
    @tag($tag, $attributes, $slot->isEmpty() ? $message : $slot)
@endif