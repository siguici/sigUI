<?php

namespace Tests\Unit;

use Livewire\Livewire;
use Sikessem\UI\Components\HelloLivewire;

it('should render livewire component', function () {
    Livewire::test(HelloLivewire::class)->assertSeeHtml('Hello');
});
