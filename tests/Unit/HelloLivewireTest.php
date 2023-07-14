<?php

namespace Tests\Unit;

use Sikessem\UI\Components\HelloLivewire;

it('should render livewire component', function () {
    expect('Hello')->toSeeInRenderOf(HelloLivewire::class);
});
