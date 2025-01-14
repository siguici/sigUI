<?php

it('should render link component', function () {
    expect('<a href="http://localhost">Click me</a>')
        ->toBeRenderOf('<s-link href="/" text="Click me"/>');
});
