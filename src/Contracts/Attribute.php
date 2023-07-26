<?php

namespace Sikessem\UI\Contracts;

interface Attribute
{
    public function setName(string $name): static;

    public function getName(): string;

    public function setValue(null|bool|int|float|string $value): static;

    public function getValue(): null|bool|int|float|string;
}
