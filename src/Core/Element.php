<?php

namespace Sikessem\UI\Core;

use Sikessem\UI\Concerns;
use Sikessem\UI\Contracts\Attribute;
use Sikessem\UI\Contracts\Node;
use Sikessem\UI\Core\Node as Base;

class Element extends Base
{
    use Concerns\HasAttributes;
    use Concerns\HasName;
    use Concerns\HasNodes;

    /**
     * @param  array<string,bool|int|float|string>|Attribute[]  $attributes
     */
    public function __construct(string $name, array $attributes = [], Node ...$nodes)
    {
        $this->setName($name)->setAttributes($attributes)->setNodes($nodes);
    }

    public function isEmpty(): bool
    {
        return $this->hasNotNodes();
    }

    public function isNotEmpty(): bool
    {
        return $this->hasNodes();
    }

    public function getContent(): string
    {
        $content = '';

        foreach ($this->nodes as $nodes) {
            $content .= $nodes->getContent();
        }

        return $content;
    }
}
