<?php

use Pest\Exceptions\InvalidExpectationValue;
use PHPUnit\Framework\Assert;

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeRenderOf', function (string $component) {
    $this->value = render($this->value);

    return $this->toEqual(render($component));
});

expect()->extend('render', function () {
    echo render($this->value);

    return $this;
});

expect()->extend('dumpRender', function () {
    if (function_exists('dump')) {
        dump(render($this->value));
    } else {
        var_dump(render($this->value));
    }

    return $this;
});

expect()->extend('ddRender', function () {
    if (function_exists('dd')) {
        dd(render($this->value));
    } else {
        var_dump(render($this->value));
        exit(1);
    }

    return $this;
});

expect()->extend('toContainInOrder', function (mixed ...$needles) {
    $value = $this->value;
    foreach ($needles as $needle) {
        if (is_string($value)) {
            Assert::assertStringContainsString((string) $needle, $value);
            $value = substr_replace($value, '', 0, strpos($value, (string) $needle) + strlen((string) $needle));
        } else {
            if (! is_iterable($value)) {
                InvalidExpectationValue::expected('iterable');
            }
            Assert::assertContains($needle, $value);
            array_splice($value, 0, array_search($needle, $value, true) + 1);
        }
    }

    return $this;
});
