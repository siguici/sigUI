<?php

namespace Sigui\UI\Contracts;

interface IsComponentConfig extends IsConfig
{
    /**
     * @template TValue of string
     *
     * @param  TValue  $default
     * @return TValue
     */
    public function getTag(string $default = ''): string;

    /**
     * @param  array<string,string>  $default
     * @return array<string,string>
     */
    public function getAttributes(array $default = []): array;

    /**
     * @template TValue of string
     *
     * @param  TValue  $default
     * @return TValue
     */
    public function getContents(string $default = ''): string;

    /**
     * @param  array<string,IsComponentConfig>  $default
     * @return array<string,IsComponentConfig>
     */
    public function getVariants(array $default = []): array;
}
