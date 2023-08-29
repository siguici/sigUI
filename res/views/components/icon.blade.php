@php
$attributes = $attributes->merge(compact('width', 'height'));
@endphp

@if ($tag === 'svg')
    @tag($tag, $attributes->merge(['xmlns' => 'http://www.w3.org/2000/svg', 'fill' => 'none', 'viewBox' => "0 0 $width $height"]), $contents)
@elseif($tag === 'img')
    @tag($tag, $attributes->merge(['src' => $url, 'alt' => "$name icon"]))
@else
    @tag($tag, $attributes->merge(['aria-label' => $slot->isEmpty() ? "$name icon" : null])->style("content:url($url)"))
    {{ $slot }}
    @endtag
@endif