<?php

namespace Sikessem\UI\Contracts;

interface IsComponent
{
    /**
     * Get the view / view contents that represent the component.
     *
     * @return mixed
     */
    public function render();
}
