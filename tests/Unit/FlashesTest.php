<?php

namespace Tests\Unit;

it('should render flashes component', function () {
    expect('')->toBeRenderOf('<x-ui-flashes/>');

    $messages = "['success' => 'Success', 'failure' => 'Failure']";
    expect('<ul><li>Success</li><li>Failure</li></ul>')
        ->toBeRenderOf('<x-ui-flashes :messages="'.$messages.'"/>')
        ->toBeRenderOf('<x-ui::flashes :messages="'.$messages.'"/>');
});
