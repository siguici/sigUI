<?php

namespace Tests\Unit;

use Sikessem\UI\Components\HelloLivewire;

it('should render livewire component', function () {
    $this->livewire(HelloLivewire::class)->assertSee('Hello');
});
