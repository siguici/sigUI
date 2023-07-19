@php
$flashElement ??= config('ui.flashes.flash.element', 'li');
$flashAttributes ??= config('ui.flashes.flash.attributes', []);
@endphp

@ui(config('ui.flashes.element', $element), $attributes)
@foreach($list as $index => $flash)
    @if (is_string($index))
        @ui('flash', ['element' => $flashElement, 'type' => $index, 'text' => $flash, ...$flashAttributes])
    @else
        @ui('flash', ['element' => $flashElement, 'type' => $flash, ...$flashAttributes])
    @endif
@endforeach
@endui
