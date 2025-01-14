<?php

it('should render label component', function () {
    expect('<label for="name">Name</label>')
        ->toBeRenderOf('<s-label for="name" text="Name"/>')
        ->toBeRenderOf('<s-label for="name">Name</s-label>');
});
