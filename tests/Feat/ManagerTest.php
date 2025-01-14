<?php

use Sigui\UI\Contracts\IsManager;

test('ui() helper should be an instance of '.IsManager::class, function () {
    expect(ui())->toBeInstanceOf(IsManager::class);
});
