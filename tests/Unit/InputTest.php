<?php

it('should render input component', function () {
    $this->withViewErrors([])->blade('<s-input/>')->assertSee(
        '<input type="text" name="text" id="text" aria-invalid="false"/>',
        false
    );
});

it('should render input button component', function () {
    $this->withViewErrors([])->blade('<s-button-input name="button"/>')->assertSee(
        '<input type="button" name="button" id="button" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="button" name="button"/>')->assertSee(
        '<input type="button" name="button" id="button" aria-invalid="false"/>',
        false
    );
});

it('should render input checkbox component', function () {
    $this->withViewErrors([])->blade('<s-checkbox-input name="checkbox"/>')->assertSee(
        '<input type="checkbox" name="checkbox" id="checkbox" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="checkbox" name="checkbox"/>')->assertSee(
        '<input type="checkbox" name="checkbox" id="checkbox" aria-invalid="false"/>',
        false
    );
});

it('should render input color component', function () {
    $this->withViewErrors([])->blade('<s-color-input name="color"/>')->assertSee(
        '<input type="color" name="color" id="color" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="color" name="color"/>')->assertSee(
        '<input type="color" name="color" id="color" aria-invalid="false"/>',
        false
    );
});

it('should render input date component', function () {
    $this->withViewErrors([])->blade('<s-date-input name="date"/>')->assertSee(
        '<input type="date" name="date" id="date" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="date" name="date"/>')->assertSee(
        '<input type="date" name="date" id="date" aria-invalid="false"/>',
        false
    );
});

it('should render input datetime component', function () {
    $this->withViewErrors([])->blade('<s-datetime-local-input name="datetime"/>')->assertSee(
        '<input type="datetime-local" name="datetime" id="datetime" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="datetime-local" name="datetime"/>')->assertSee(
        '<input type="datetime-local" name="datetime" id="datetime" aria-invalid="false"/>',
        false
    );
});

it('should render input email component', function () {
    $this->withViewErrors([])->blade('<s-email-input name="email"/>')->assertSee(
        '<input type="email" name="email" id="email" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="email" name="email"/>')->assertSee(
        '<input type="email" name="email" id="email" aria-invalid="false"/>',
        false
    );
});

it('should render input file component', function () {
    $this->withViewErrors([])->blade('<s-file-input name="file"/>')->assertSee(
        '<input type="file" name="file" id="file" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="file" name="file"/>')->assertSee(
        '<input type="file" name="file" id="file" aria-invalid="false"/>',
        false
    );
});

it('should render input hidden component', function () {
    $this->withViewErrors([])->blade('<s-hidden-input name="hidden"/>')->assertSee(
        '<input type="hidden" name="hidden" id="hidden" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="hidden" name="hidden"/>')->assertSee(
        '<input type="hidden" name="hidden" id="hidden" aria-invalid="false"/>',
        false
    );
});

it('should render input image component', function () {
    $this->withViewErrors([])->blade('<s-image-input name="image"/>')->assertSee(
        '<input type="image" name="image" id="image" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="image" name="image"/>')->assertSee(
        '<input type="image" name="image" id="image" aria-invalid="false"/>',
        false
    );
});

it('should render input month component', function () {
    $this->withViewErrors([])->blade('<s-month-input name="month"/>')->assertSee(
        '<input type="month" name="month" id="month" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="month" name="month"/>')->assertSee(
        '<input type="month" name="month" id="month" aria-invalid="false"/>',
        false
    );
});

it('should render input number component', function () {
    $this->withViewErrors([])->blade('<s-number-input name="number"/>')->assertSee(
        '<input type="number" name="number" id="number" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="number" name="number"/>')->assertSee(
        '<input type="number" name="number" id="number" aria-invalid="false"/>',
        false
    );
});

it('should render input password component', function () {
    $this->withViewErrors([])->blade('<s-password-input name="password"/>')->assertSee(
        '<input type="password" name="password" id="password" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="password" name="password"/>')->assertSee(
        '<input type="password" name="password" id="password" aria-invalid="false"/>',
        false
    );
});

it('should render input radio component', function () {
    $this->withViewErrors([])->blade('<s-radio-input name="radio"/>')->assertSee(
        '<input type="radio" name="radio" id="radio" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="radio" name="radio"/>')->assertSee(
        '<input type="radio" name="radio" id="radio" aria-invalid="false"/>',
        false
    );
});

it('should render input range component', function () {
    $this->withViewErrors([])->blade('<s-range-input name="range"/>')->assertSee(
        '<input type="range" name="range" id="range" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="range" name="range"/>')->assertSee(
        '<input type="range" name="range" id="range" aria-invalid="false"/>',
        false
    );
});

it('should render input reset component', function () {
    $this->withViewErrors([])->blade('<s-reset-input name="reset"/>')->assertSee(
        '<input type="reset" name="reset" id="reset" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="reset" name="reset"/>')->assertSee(
        '<input type="reset" name="reset" id="reset" aria-invalid="false"/>',
        false
    );
});

it('should render input search component', function () {
    $this->withViewErrors([])->blade('<s-search-input name="search"/>')->assertSee(
        '<input type="search" name="search" id="search" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="search" name="search"/>')->assertSee(
        '<input type="search" name="search" id="search" aria-invalid="false"/>',
        false
    );
});

it('should render input submit component', function () {
    $this->withViewErrors([])->blade('<s-submit-input name="submit"/>')->assertSee(
        '<input type="submit" name="submit" id="submit" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="submit" name="submit"/>')->assertSee(
        '<input type="submit" name="submit" id="submit" aria-invalid="false"/>',
        false
    );
});

it('should render input tel component', function () {
    $this->withViewErrors([])->blade('<s-tel-input name="tel"/>')->assertSee(
        '<input type="tel" name="tel" id="tel" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="tel" name="tel"/>')->assertSee(
        '<input type="tel" name="tel" id="tel" aria-invalid="false"/>',
        false
    );
});

it('should render input text component', function () {
    $this->withViewErrors([])->blade('<s-text-input name="text"/>')->assertSee(
        '<input type="text" name="text" id="text" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="text" name="text"/>')->assertSee(
        '<input type="text" name="text" id="text" aria-invalid="false"/>',
        false
    );
});

it('should render input time component', function () {
    $this->withViewErrors([])->blade('<s-time-input name="time"/>')->assertSee(
        '<input type="time" name="time" id="time" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="time" name="time"/>')->assertSee(
        '<input type="time" name="time" id="time" aria-invalid="false"/>',
        false
    );
});

it('should render input url component', function () {
    $this->withViewErrors([])->blade('<s-url-input name="url"/>')->assertSee(
        '<input type="url" name="url" id="url" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="url" name="url"/>')->assertSee(
        '<input type="url" name="url" id="url" aria-invalid="false"/>',
        false
    );
});

it('should render input week component', function () {
    $this->withViewErrors([])->blade('<s-week-input name="week"/>')->assertSee(
        '<input type="week" name="week" id="week" aria-invalid="false"/>',
        false
    );

    $this->withViewErrors([])->blade('<s-input type="week" name="week"/>')->assertSee(
        '<input type="week" name="week" id="week" aria-invalid="false"/>',
        false
    );
});
