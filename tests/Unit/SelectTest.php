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
        '<option value="0">',
        'red',
        '</option>',
        '<option value="1">',
        'green',
        '</option>',
        '<option value="2">',
        'blue',
        '</option>',
        '</optgroup>',
        '<optgroup label="Value">',
        '<option value="0">',
        'Red',
        '</option>',
        '<option value="1">',
        'Green',
        '</option>',
        '<option value="2">',
        'Blue',
        '</option>',
        '</optgroup>',
        '</select>',
    ], false);
});
