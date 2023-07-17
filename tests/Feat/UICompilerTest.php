<?php

namespace Tests\Unit;

it('should compile tag', function () {
    expect('Hello')->toBeRenderOf('<ui-text value="Hello"/>');
});
