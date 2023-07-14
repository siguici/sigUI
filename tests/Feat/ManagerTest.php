<?php

namespace Tests\Feat;

use Sikessem\UI\Core\Manager;

test('ui() helper should be an instance of '.Manager::class, function () {
    expect(ui())->toBeInstanceOf(Manager::class);
});
