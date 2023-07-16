<?php

namespace Tests\Unit;

it('should render text component', function () {
    expect('<div >Hello</div>')
        ->toBeRenderOf('<x-ui-text value="Hello" tag="div"/>')
        ->toBeRenderOf('<x-ui::text value="Hello" tag="div"/>');
});
