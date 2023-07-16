<?php

namespace Tests\Unit;

it('should render link component', function () {
    expect('<a href="http://localhost" >Click me</a>')
        ->toBeRenderOf('<x-ui-link href="/" text="Click me"/>')
        ->toBeRenderOf('<x-ui::link href="/" text="Click me"/>');
});
