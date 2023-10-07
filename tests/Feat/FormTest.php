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
        '<form action="#" method="GET">',
        '<input type="hidden" name="_token" value="" autocomplete="off">',
        '<p >',
        'Input name required',
        '</p>',
        '</form>',
    ], false);
});

it('should render GET form', function () {
    $view = $this->withViewErrors([
        'name' => 'Input name required',
    ])->blade('<s-form method="get"/>');

    $view->assertSeeInOrder([
        '<form action="#" method="GET">',
        '<input type="hidden" name="_method" value="GET">',
        '</form>',
    ], false);
});

it('should render POST form', function () {
    $view = $this->withViewErrors([
        'name' => 'Input name required',
    ])->blade('<s-form method="post"/>');

    $view->assertSeeInOrder([
        '<form action="#" method="POST">',
        '<input type="hidden" name="_method" value="POST">',
        '</form>',
    ], false);
});

it('should render PUT form', function () {
    $view = $this->withViewErrors([
        'name' => 'Input name required',
    ])->blade('<s-form method="put"/>');

    $view->assertSeeInOrder([
        '<form action="#" method="POST">',
        '<input type="hidden" name="_method" value="PUT">',
        '</form>',
    ], false);
});

it('should render DELETE form', function () {
    $view = $this->withViewErrors([
        'name' => 'Input name required',
    ])->blade('<s-form method="delete"/>');

    $view->assertSeeInOrder([
        '<form action="#" method="POST">',
        '<input type="hidden" name="_method" value="DELETE">',
        '</form>',
    ], false);
});
