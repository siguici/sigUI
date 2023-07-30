<?php

namespace Tests\Feat;

it('should render UI blade component', function () {
    expect('Sikessem')->toBeRenderOf('@ui("text", ["value" => "Sikessem"])');
    expect('<a href="http://localhost">Sikessem</a>')->toBeRenderOf('@ui("link", ["href" => "/", "text" => "Sikessem"])');
});

it('should render UI Livewire component', function () {
    expectRender('@ui("hello-livewire")')->toContain('Hello');
});

it('should render self-closing HTML tags', function () {
    expect('<br/>')->toBeRenderOf('@tag("br")');
    expect('<img src="..."/>')->toBeRenderOf('@tag("img", ["src" => "..."])');
});

it('should render open and close HTML tags', function () {
    expect('<div class="app">Hello World !</div>')
        ->toBeRenderOf('@tag("div", ["class" => "app"], "Hello World !")')
        ->toBeRenderOf('@tag("div", ["class" => "app"])Hello World !@endtag');
});

it('should render custom component', function () {
    expect('<custom-element id="myElement" class="my custom element">Custom Element</custom-element>')->toBeRenderOf('@ui("custom", ["class" => "element", "id" => "myElement"], "Custom Element")');
});
