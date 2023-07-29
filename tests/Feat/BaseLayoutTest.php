<?php

namespace Tests\Unit;

it('should render anonymous component', function () {
    $this->blade(<<<'BLADE'
<s-base-layout>
    Hello World!
</s-base-layout>
BLADE)->assertSeeInOrder(['ui-root', config('app.name', 'Sikessem'), 'ui-app', 'Hello World!']);

    $this->blade(<<<'BLADE'
<s-base-layout>
    <x-slot:head>
        <meta name="author" content="Sigui Kessé Emmanuel"/>
    </x-slot:head>
    <x-slot:body>
        Hello World!
    </x-slot:body>
</s-base-layout>
BLADE)->assertSeeInOrder(['Sigui Kessé Emmanuel', 'Hello World!']);
});
