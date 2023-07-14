<?php

namespace Tests\Unit;

it('should render anonymous component', function () {
    expect(<<<'HTML'
<!DOCTYPE html>
<head>
</head>
<body>
    Hello World!
</body>
HTML)->toBeRenderOf(<<<'BLADE'
@extends('ui::layouts.base')

@section('content')
Hello World!
@endsection
BLADE);
});
