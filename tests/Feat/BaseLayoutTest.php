<?php

it('should render anonymous component', function () {
    $this->blade(<<<'BLADE'
<s-base-layout>
    Hello World!
</s-base-layout>
BLADE)->assertSeeInOrder(['ui-root', config('app.name', 'Sikessem'), 'ui-app', 'Hello World!']);

    $this->blade(<<<'BLADE'
<s-base-layout>
    <s:head>
        <meta name="author" content="Sigui Kessé Emmanuel"/>
    </s:head>
    <s:body>
        Hello World!
    </s:body>
</s-base-layout>
BLADE)->assertSeeInOrder(['Sigui Kessé Emmanuel', 'Hello World!']);
});
