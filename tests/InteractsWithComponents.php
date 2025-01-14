<?php

namespace Sikessem\UI\Tests;

use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Pest\Expectation;

trait InteractsWithComponents
{
    use InteractsWithViews;

    public function render(string $template): Expectation
    {
        return expect(render($template));
    }
}
