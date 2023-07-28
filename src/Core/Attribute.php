<?php

namespace Sikessem\UI\Core;

use Sikessem\UI\Contracts\Attribute as AttributeContract;

class Attribute implements AttributeContract
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

    public static function from(string $name, bool|int|float|string $value = null): self
    {
        return new self($name, $value);
    }
}
