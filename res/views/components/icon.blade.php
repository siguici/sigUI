@php
$attributes = $attributes->merge(compact('width', 'height'));
@endphp

@if ($element === 'svg')
    @tag($element, $attributes->merge(['xmlns' => 'http://www.w3.org/2000/svg', 'fill' => 'none', 'viewBox' => "0 0 $width $height"]), $content)
@elseif($element === 'img')
    @tag($element, $attributes->merge(['src' => $url, 'alt' => "$name-icon"]))
@else
    @tag($element, $attributes->style("content:url($url)"))
    {{ $slot }}
    @endtag
@endif