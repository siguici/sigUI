<?php

namespace Sikessem\UI\Core;

use Sikessem\UI\Concerns;
use Sikessem\UI\Contracts\Document as DocumentContract;
use Sikessem\UI\Contracts\Element;

class Document implements DocumentContract
{
    use Concerns\HasType;

    protected Element $root;

    public function __construct(string $type, Element $root)
    {
        $this->setType($type)->setRoot($root);
    }

    public function setRoot(Element $root): static
    {
        $this->root = $root;

        return $this;
    }

    public function getRoot(): Element
    {
        return $this->root;
    }
}
