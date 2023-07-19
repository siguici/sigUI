<?php

namespace Tests\Unit;

it('should render label component', function () {
    expect('<label for="name">Name</label>')
        ->toBeRenderOf('<x-ui-label for="name" text="Name"/>')
        ->toBeRenderOf('<x-ui::label for="name" text="Name"/>')
        ->toBeRenderOf('<x-ui-label for="name">Name</x-ui-label>')
        ->toBeRenderOf('<x-ui::label for="name">Name</x-ui::label>');
});
