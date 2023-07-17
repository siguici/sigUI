<?php

namespace Tests\Unit;

it('should render button component', function () {
    expectRender('<x-ui-button>Click me</x-ui-button>')->toContain('<button type="button" >Click me</button>');
    expectRender('<x-ui-button type="submit">Click me</x-ui-button>')->toContain('<button type="submit" >Click me</button>');
    expectRender('<x-ui-button type="submit" href="/">Click me</x-ui-button>')->toContain('<a href="http://localhost" >Click me</a>');
});
