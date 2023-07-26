<?php

namespace Sikessem\UI\Concerns;

use Sikessem\UI\Contracts\Node;

trait HasNodes
{
    /**
     * @var Node[]
     */
    protected array $nodes;

    /**
     * @param  Node[]  $nodes
     */
    public function setNodes(array $nodes): static
    {
        $this->clearNodes();

        return $this->this->addNodes($nodes);
    }

    public function clearNodes(): static
    {
        $this->nodes = [];

        return $this;
    }

    /**
     * @param  Node[]  $nodes
     */
    public function addNodes(array $nodes): static
    {
        foreach ($nodes as $node) {
            $this->addNode($node);
        }

        return $this;
    }

    /**
     * @return Node[] $nodes
     */
    public function getNodes(): array
    {
        return $this->nodes;
    }

    public function hasNodes(): bool
    {
        return ! empty($this->nodes);
    }

    public function hasNotNodes(): bool
    {
        return empty($this->nodes);
    }

    public function addNode(Node $node): static
    {
        $this->nodes[] = $node;

        return $this;
    }
}
