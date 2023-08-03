<?php

namespace Sikessem\UI\Concerns;

trait HasType
{
    protected string $type;

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
