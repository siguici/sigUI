<?php

namespace Tests\Unit;

it('should render anonymous component', function () {
    expect('<div>Hello</div>')
        ->toBeRenderOf('<x-ui-hello/>')
        ->toBeRenderOf('<x-ui::hello/>');
});
