<?php

namespace Tests\Unit;

it('should render text component', function () {
    expect('Sigui Kessé Emmanuel&lt;contact@sigui.ci&gt;')
        ->toBeRenderOf('<x-ui-text value="Sigui Kessé Emmanuel<contact@sigui.ci>" escape/>')
        ->toBeRenderOf('<x-ui::text value="Sigui Kessé Emmanuel<contact@sigui.ci>" escape/>');
});
