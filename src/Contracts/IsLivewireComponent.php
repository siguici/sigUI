<?php

namespace Sikessem\UI\Contracts;

interface IsLivewireComponent extends IsComponent
{
    /**
     * Get the view / view contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render();

    public static function getName();

    public function getQueryString();

    public function skipRender();

    public function renderToView();

    public function output($errors = null);

    public function forgetComputed($key = null);

    public function addToStack($stack, $type, $contents, $key = null);

    public function getForStack();
}
