<?php

it('should render input component', function () {
    $this->withViewErrors([])->blade('<s-entry type="email" autocomplete/>')->assertSee(
        '<input type="email" name="email" id="email" aria-invalid="false" autocomplete="email"/>',
        false
    );
});

it('should render textarea component', function () {
    $this->withViewErrors([])->blade('<s-entry type="textarea" name="comment" autocomplete/>')->assertSeeInOrder([
        '<textarea name="comment" id="comment" aria-invalid="false" autocomplete="comment">',
        '</textarea>',
    ], false);
});

it('should render datalist', function () {
    $this->withViewErrors([])->blade('<s-entry :datalist="[\'Emmanuel\', \'Kessé\', \'Sigui\']"/>')->assertSeeInOrder([
        '<input type="text" name="text" id="text" aria-invalid="false" autocomplete="text" list="text-input-datalist"/>',
        '<datalist id="text-input-datalist">',
        '<option >Emmanuel</option>',
        '<option >Kessé</option>',
        '<option >Sigui</option>',
        '</datalist>',
    ], false);
});
