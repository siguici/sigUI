<?php

namespace Sikessem\UI\Concerns;

use Sikessem\UI\Contracts\Attribute as AttributeContract;
use Sikessem\UI\Core\Attribute;

trait HasAttributes
{
    /**
     * @var AttributeContract[]
     */
    protected array $attributes = [];

    public function setAttributes(array $attributes): static
    {
        foreach ($attributes as $name => $attribute) {
            $attribute instanceof AttributeContract
            ? $this->setAttribute($attribute)
            : $this->setAttribute($name, $attribute);
        }

        return $this;
    }

    /**
     * @return AttributeContract[]
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

    public function setAttribute(string|AttributeContract $attribute, bool|int|float|string $value = null): static
    {
        if (! $attribute instanceof AttributeContract) {
            $attribute = Attribute::from($attribute, $value);
        }

        if ($_attribute = $this->getAttribute($attribute)) {
            $_attribute->setValue($attribute->getValue());
        } else {
            $this->addAttribute($attribute);
        }

        return $this;
    }

    public function addAttribute(AttributeContract $attribute): static
    {
        $this->attributes[] = $attribute;

        return $this;
    }

    public function getAttribute(string|AttributeContract $attribute, AttributeContract $default = null): ?AttributeContract
    {
        if (! $attribute instanceof AttributeContract) {
            $attribute = Attribute::from($attribute);
        }

        foreach ($this->getAttributes() as $_attribute) {
            if ($attribute->getName() === $_attribute->getName()) {
                return $_attribute;
            }
        }

        return $default;
    }

    public function hasAttribute(string|AttributeContract $attribute): bool
    {
        return ! is_null($this->getAttribute($attribute));
    }
}
