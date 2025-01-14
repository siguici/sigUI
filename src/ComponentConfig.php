<?php

namespace Sigui\UI;

use Sigui\UI\Contracts\IsComponentConfig;

class ComponentConfig extends Config implements IsComponentConfig
{
    /**
     * @template TValue of string
     *
     * @param  TValue  $default
     * @return TValue
     */
    public function getTag(string $default = ''): string
    {
        return $this->get('tag', $default) ?: $default;
    }

    /**
     * @param  array<string,string>  $default
     * @return array<string,string>
     */
    public function getAttributes(array $default = []): array
    {
        return $this->get('attributes', $default) ?: $default;
    }

    /**
     * @template TValue of string
     *
     * @param  TValue  $default
     * @return TValue
     */
    public function getContents(string $default = ''): string
    {
        return $this->get('contents', $default) ?: $default;
    }

    /**
     * @param  array<string,IsComponentConfig>  $default
     * @return array<string,IsComponentConfig>
     */
    public function getVariants(array $default = []): array
    {
        $variants = $this->get('variants', $default) ?: $default;

        foreach ($variants as $variant => $options) {
            $variants[$variant] = new ComponentConfig((array) $options);
        }

        return $variants;
    }
}
