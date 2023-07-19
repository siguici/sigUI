@ui($element ?: config('ui.flash.element', 'p'), $attributes)
@if ($message = session($type, $text))
<x-ui::text :value="$message"/>
@else
{{ $slot }}
@endif
@endui