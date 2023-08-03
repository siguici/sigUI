<?php

namespace Sikessem\UI\Concerns;

trait HasName
{
    protected string $name;

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
