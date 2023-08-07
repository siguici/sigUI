<?php

it('should render textarea component', function () {
    $this->withViewErrors([])->blade('<s-textarea name="comment"/>')->assertSeeInOrder([
        '<textarea name="comment" id="comment" aria-invalid="false">',
        '</textarea>',
    ], false);
});
