<?php

namespace Sikessem\UI\Contracts;

interface Element extends Node
{
    public function setName(string $name): static;

    public function getName(): string;
}
