<?php

namespace Sikessem\UI\Contracts;

interface Document
{
    public function setType(string $type): static;

    public function setRoot(Element $root): static;

    public function getType(): string;

    public function getRoot(): Element;
}
