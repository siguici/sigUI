<?php

it('should render button component', function () {
    expectRender('<s-button>Click me</s-button>')->toContain('<button type="button">Click me</button>');
    expectRender('<s-button text="Click me"/>')->toContain('<button type="button">Click me</button>');
});

it('should render link button', function () {
    expectRender('<s-button href="/">Click me</s-button>')->toContain('<a href="http://localhost">Click me</a>');
});

it('should render input button', function () {
    expectRender('<s-button name="send" value="Click me"/>')->toContain('<input type="button" name="send" value="Click me"/>');
});

it('should render image button', function () {
    expectRender('<s-button type="image">Click me</s-button>')->toContain('<button type="image">Click me</button>');
    expectRender('<s-image-button>Click me</s-image-button>')->toContain('<button type="image">Click me</button>');
});

it('should render reset button', function () {
    expectRender('<s-button type="reset">Click me</s-button>')->toContain('<button type="reset">Click me</button>');
    expectRender('<s-reset-button>Click me</s-reset-button>')->toContain('<button type="reset">Click me</button>');
});

it('should render submit button', function () {
    expectRender('<s-button type="submit">Click me</s-button>')->toContain('<button type="submit">Click me</button>');
    expectRender('<s-submit-button>Click me</s-submit-button>')->toContain('<button type="submit">Click me</button>');
});
