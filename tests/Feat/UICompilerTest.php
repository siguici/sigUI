<?php

namespace Tests\Unit;

it('should compile tag', function () {
    expect('Hello')->toBeRenderOf('<s-text value="Hello"/>');
});
