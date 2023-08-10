<?php

namespace Sikessem\UI\Concerns;

use Closure;
use Sikessem\UI\UIFacade;

trait HandlesComponentAlias
{
    public function handleAlias(Closure $action): static
    {
        $prefix = preg_quote(UIFacade::prefix(), '/');
        $suffix = preg_quote(UIFacade::getAlias(get_class($this)), '/');
        if (preg_match("/$prefix-(?P<alias>.*?)-$suffix/", $this->componentName, $matches)) {
            $action($matches['alias'], $this);
        }

        return $this;
    }
}
