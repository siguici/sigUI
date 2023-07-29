<?php

namespace Tests\Unit;

it('should render text component', function () {
    expect('Sigui Kessé Emmanuel&lt;contact@sigui.ci&gt;')->toBeRenderOf('<s-text value="Sigui Kessé Emmanuel<contact@sigui.ci>"/>');
});
