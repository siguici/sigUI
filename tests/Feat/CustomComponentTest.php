<?php

namespace Tests\Unit;

it('should render HTML element', function () {
    expect('<custom-element id="myElement" class="my custom element">Custom Element</custom-element>')->toBeRenderOf('@ui("custom", ["class" => "element", "id" => "myElement"], "Custom Element")');
});
