<?php

namespace Sikessem\UI\Core;

class Text extends Node
{
    protected string $content;

    public function __construct(string $content)
    {
        $this->setContent($content);
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function isEmpty(): bool
    {
        return empty($this->content);
    }

    public function isNotEmpty(): bool
    {
        return ! $this->isEmpty();
    }
}
