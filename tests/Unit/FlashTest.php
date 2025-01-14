<?php

it('should render flash component', function () {
    expect('')->toBeRenderOf('<s-flash type="info"/>');
    expect('<p class="alert">Information</p>')->toBeRenderOf('<s-flash type="info" message="Information" class="alert" />');
    expect('<p>Welcome</p>')->toBeRenderOf('<s-flash type="info" message="Welcome"/>');
});
