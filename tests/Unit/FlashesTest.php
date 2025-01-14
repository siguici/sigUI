<?php

it('should render flashes component', function () {
    expect('')->toBeRenderOf('<s-flashes/>');

    $messages = "['success' => 'Success', 'failure' => 'Failure']";
    expect('<ul><li>Success</li><li>Failure</li></ul>')->toBeRenderOf('<s-flashes :messages="'.$messages.'"/>');
});
