<?php

namespace Tests\Unit;

it('should render HTML element', function () {
    expect('<div class="app">Hello</div>')->toBeRenderOf('@ui("div", ["class" => "app"], "Hello")');
    expect('<img src="...">')->toBeRenderOf('@ui("img", ["src" => "..."])');
});

it('should render Blade component', function () {
    expect('Sikessem')->toBeRenderOf('@ui("text", ["value" => "Sikessem"])');
    expect('<a href="http://localhost" >Sikessem</a>')->toBeRenderOf('@ui("link", ["href" => "/", "text" => "Sikessem"])');
});

it('should render Livewire component', function () {
    expectRender('@ui("hello-livewire")')->toContain('Hello');
});

it('should open HTML tag', function () {
    expectRender('@ui("div")Hello World !@endui')->toEqual('<div >Hello World !</div>');
});
