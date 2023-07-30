<?php

namespace Tests\Feat;

use Sikessem\UI\UIManager;

test('ui() helper should be an instance of '.UIManager::class, function () {
    expect(ui())->toBeInstanceOf(UIManager::class);
});
