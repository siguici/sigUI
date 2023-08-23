<?php

namespace Sikessem\UI\Concerns;

use Closure;
use Sikessem\UI\Facade;

trait HandlesComponentAlias
{
    public function handleAlias(Closure $action): static
    {
        $prefix = preg_quote(Facade::prefix(), '/');
        $suffix = preg_quote(Facade::getAlias(get_class($this)), '/');
        if (preg_match("/$prefix-(?P<alias>.*?)-$suffix/", $this->componentName, $matches)) {
            $action($matches['alias'], $this);
        }

        return $this;
    }
}
