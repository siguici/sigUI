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

expect()->extend('toBeRenderOf', fn (string $component) => $this->toEqual(render($component)));
expect()->extend('toContainInOrder', function (mixed ...$needles) {
    $value = $this->value;
    foreach ($needles as $needle) {
        if (is_string($value)) {
            Assert::assertStringContainsString((string) $needle, $value);
            $value = substr_replace($value, '', 0, strpos($value, $needle) + strlen($needle));
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
