<?php

namespace Tests\Feat;

use Sikessem\UI\Core\Manager;

it('returns a successful response', function () {
    expect(ui())->toBeInstanceOf(Manager::class);
});
