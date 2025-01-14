<?php

namespace Sigui\UI\Contracts;

interface IsConfig
{
    /**
     * @template TKey of int|string
     * @template TValue of mixed
     *
     * @param  TKey  $key
     * @param  TValue  $default
     * @return TValue
     */
    public function get(int|string $key, mixed $default): mixed;

    public function set(int|string $key, mixed $value): static;

    public function __toArray(): array;
}
