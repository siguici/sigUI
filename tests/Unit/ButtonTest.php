<?php

namespace Tests\Unit;

it('should render button component', function () {
    expectRender('<s-button>Click me</s-button>')->toContain('<button type="button">Click me</button>');
    expectRender('<s-button type="submit">Click me</s-button>')->toContain('<button type="submit">Click me</button>');
    expectRender('<s-button type="submit" href="/">Click me</s-button>')->toContain('<a href="http://localhost">Click me</a>');
});
