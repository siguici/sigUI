<?php

namespace Tests\Unit;

it('should render blade component', function () {
    expect('Hello')
        ->toBeRenderOf('<x-ui-hello-blade/>')
        ->toBeRenderOf('<x-ui::hello-blade/>');
});
