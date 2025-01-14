<?php

it('should compile self-closing tag', function () {
    expect('Hello')->toBeRenderOf('<s-text value="Hello"/>');
});

it('should compile opening and closing tag', function () {
    expect('<a href="http://localhost">Back to home</a>')->toBeRenderOf('<s-link href="/">Back to home</s-link>');
});
