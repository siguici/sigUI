<?php

namespace Tests\Unit;

it('should render flash component', function () {
    expect('<p></p>')->toBeRenderOf('<x-ui-flash type="info"/>');
    expect('<p class="alert"></p>')->toBeRenderOf('<x-ui-flash type="info" class="alert" />');

    expect('<p>Welcome</p>')
        ->toBeRenderOf('<x-ui-flash type="info" text="Welcome"/>')
        ->toBeRenderOf('<x-ui::flash type="info">Welcome</x-ui::flash>');
});
