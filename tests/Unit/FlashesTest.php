<?php

namespace Tests\Unit;

it('should render flashes component', function () {
    expect('<ul></ul>')->toBeRenderOf('<x-ui-flashes/>');

    $items = "['success' => 'Success', 'failure' => 'Failure']";
    expect('<ul><li>Success</li><li>Failure</li></ul>')
        ->toBeRenderOf('<x-ui-flashes :list="'.$items.'"/>')
        ->toBeRenderOf('<x-ui::flashes :list="'.$items.'"/>');
});
