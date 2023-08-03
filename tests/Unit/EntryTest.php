<?php

namespace Sikessem\UI\Tests\Unit;

it('should render input component', function () {
    $this->withViewErrors([])->blade('<s-entry type="email" autocomplete/>')->assertSee(
        '<input type="email" name="email" id="email" autocomplete="email" aria-invalid="false"/>',
        false
    );
});

it('should render textarea component', function () {
    $this->withViewErrors([])->blade('<s-entry type="textarea" name="comment" autocomplete/>')->assertSeeInOrder([
        '<textarea name="comment" id="comment" autocomplete="comment" aria-invalid="false">',
        '</textarea>',
    ], false);
});
