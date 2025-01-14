<?php

namespace Sigui\UI;

use Sigui\UI\Contracts\IsConfig;

class Config implements IsConfig
{
    protected array $options = [];

    /**
     * @param  mixed[]  $options
     */
    public function __construct(array $options = [])
    {
        foreach ($options as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * @template TKey of int|string
     * @template TValue of mixed
     *
     * @param  TKey  $key
     * @param  TValue  $default
     * @return TValue
     */
    public function get(int|string $key, mixed $default): mixed
    {
        return $this->options[$key] ?? $default;
    }

    public function set(int|string $key, mixed $value): static
    {
        $this->options[$key] = $value;

        return $this;
    }

    /**
     * @return mixed[]
     */
    public function __toArray(): array
    {
        return $this->options;
    }
}
