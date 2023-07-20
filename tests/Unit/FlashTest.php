<?php

namespace Tests\Unit;

it('should render flash component', function () {
    expect('')->toBeRenderOf('<x-ui-flash type="info"/>');
    expect('<p class="alert">Information</p>')->toBeRenderOf('<x-ui-flash type="info" message="Information" class="alert" />');
    expect('<p>Welcome</p>')->toBeRenderOf('<x-ui::flash type="info" message="Welcome"/>');
});
