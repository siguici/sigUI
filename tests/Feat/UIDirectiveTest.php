<?php

namespace Tests\Feat;

it('should render Blade component', function () {
    expect('Sikessem')->toBeRenderOf('@s("text", ["value" => "Sikessem"])');
    expect('<a href="http://localhost">Sikessem</a>')->toBeRenderOf('@s("link", ["href" => "/", "text" => "Sikessem"])');
});

it('should render Livewire component', function () {
    expectRender('@s("hello-livewire")')->toContain('Hello');
});

it('should render self-closing ui directive', function () {
    expect('<br/>')->toBeRenderOf('@ui("br")');
    expect('<img src="..."/>')->toBeRenderOf('@ui("img", ["src" => "..."])');
});

it('should render open and close ui directive', function () {
    expect('<div class="app">Hello World !</div>')
        ->toBeRenderOf('@ui("div", ["class" => "app"], "Hello World !")')
        ->toBeRenderOf('@ui("div", ["class" => "app"])Hello World !@endui');
});
