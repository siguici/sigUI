<?php

namespace Tests\Unit;

it('should render text component', function () {
    expect('Sigui Kessé Emmanuel<contact@sigui.ci>')->toBeRenderOf('<s-text value="Sigui Kessé Emmanuel<contact@sigui.ci>"/>');
});

it('should translate text component', function () {
    expect('Sigui Kessé Emmanuel<contact@sigui.ci>')->toBeRenderOf('<s-translate-text value="Sigui Kessé Emmanuel<contact@sigui.ci>"/>');
});

it('should escape text component', function () {
    expect('Sigui Kessé Emmanuel&lt;contact@sigui.ci&gt;')->toBeRenderOf('<s-escape-text value="Sigui Kessé Emmanuel<contact@sigui.ci>"/>');
});
