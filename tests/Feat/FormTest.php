<?php

namespace Tests\Feat;

it('should render form component', function () {
    $view = $this->withViewErrors([
        'name' => 'Input name required',
    ])->view('ui::samples.form');

    $view->assertSeeInOrder([
        '<ul >',
        '<li >',
        'Input name required',
        '</li>',
        '</ul>',
        '<form method="GET" action="#">',
        '<input type="hidden" name="_token" value="">',
        '<p >',
        'Input name required',
        '</p>',
        '</form>',
    ], false);
});
