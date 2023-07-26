<?php

namespace Sikessem\UI\Concerns;

use Sikessem\UI\Contracts\Attribute;

trait HasAttributes
{
    /**
     * @var Attribute[]
     */
    protected array $attributes = [];

    public function setAttributes(array $attributes): static
    {
        foreach ($attributes as $name => $attribute) {
            $attribute instanceof Attribute
            ? $this->setAttribute($attribute)
            : $this->setAttribute($name, $attribute);
        }

        return $this;
    }

    /**
     * @return Attribute[]
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function hasAttributes(): bool
    {
        return ! empty($this->attributes);
    }

    public function hasNotAttributes(): bool
    {
        return empty($this->attributes);
    }

    public function setAttribute(string|Attribute $attribute, bool|int|float|string $value = null): static
    {
        if (! $attribute instanceof Attribute) {
            $attribute = new Attribute($attribute, $value);
        }

        if ($this->hasAttribute($attribute)) {
            $this->getAttribute($attribute)->setValue($attribute->getValue());
        } else {
            $this->addAttribute($attribute);
        }

        return $this;
    }

    public function addAttribute(Attribute $attribute): static
    {
        $this->attributes[] = $attribute;

        return $this;
    }

    public function getAttribute(string|Attribute $attribute, Attribute $default = null): ?Attribute
    {
        if (! $attribute instanceof Attribute) {
            $attribute = new Attribute($attribute);
        }

        foreach ($this->getAttributes() as $_attribute) {
            if ($attribute->getName() === $_attribute->getName()) {
                return $_attribute;
            }
        }

        return $default;
    }

    public function hasAttribute(string|Attribute $attribute): bool
    {
        return ! is_null($this->getAttribute($attribute));
    }
}
