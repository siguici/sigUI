<?php

namespace Sikessem\UI\Core;

class Attribute
{
    protected string $name;

    protected null|bool|int|float|string $value;

    public function __construct(string $name, bool|int|float|string $value = null)
    {
        $this->setName($name)->setValue($value);
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setValue(null|bool|int|float|string $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getValue(): null|bool|int|float|string
    {
        return $this->value;
    }
}
