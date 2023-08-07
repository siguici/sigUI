<?php

beforeEach(function () {
    $this->optionsList = "['red' => 'Red', 'green' => 'Green', 'blue' => 'Blue']";
    $this->optionsGroup = "['Key' => ['red', 'green', 'blue'], 'Value' => ['Red', 'Green', 'Blue']]";
});

it('should render select component', function () {
    $this->withViewErrors([])->blade('<s-select name="color"/>')->assertSeeInOrder([
        '<select name="color" id="color" aria-invalid="false">',
        '</select>',
    ], false);
});

it('should render options list', function () {
    $this->withViewErrors([])->blade('<s-select name="color" :options="'.$this->optionsList.'"/>')->assertSeeInOrder([
        '<select name="color" id="color" aria-invalid="false">',
        '<option value="red">',
        'Red',
        '</option>',
        '<option value="green">',
        'Green',
        '</option>',
        '<option value="blue">',
        'Blue',
        '</option>',
        '</select>',
    ], false);
});

it('should render options group', function () {
    $this->withViewErrors([])->blade('<s-select name="color" :options="'.$this->optionsGroup.'"/>')->assertSeeInOrder([
        '<select name="color" id="color" aria-invalid="false">',
        '<optgroup label="Key">',
        '<option >',
        'red',
        '</option>',
        '<option >',
        'green',
        '</option>',
        '<option >',
        'blue',
        '</option>',
        '</optgroup>',
        '<optgroup label="Value">',
        '<option >',
        'Red',
        '</option>',
        '<option >',
        'Green',
        '</option>',
        '<option >',
        'Blue',
        '</option>',
        '</optgroup>',
        '</select>',
    ], false);
});
