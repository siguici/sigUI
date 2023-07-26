<?php

namespace Sikessem\UI\Contracts;

interface Node
{
    public function isEmpty(): bool;

    public function isNotEmpty(): bool;

    public function getContent(): string;
}
