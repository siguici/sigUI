<?php

namespace Sigui\UI;

use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\ComponentSlot;
use Sigui\UI\Contracts\IsComponentTag;

class ComponentTag implements IsComponentTag
{
    protected const TAGS = [
        'orphan' => [
            'area',
            'base',
            'basefont',
            'br',
            'col',
            'command',
            'embed',
            'frame',
            'hr',
            'img',
            'input',
            'isindex',
            'keygen',
            'link',
            'meta',
            'param',
            'source',
            'track',
            'wbr',
        ],
        'inline' => [
            'a',
            'abbr',
            'acronym',
            'b',
            'bdi',
            'bdo',
            'big',
            'br',
            'cite',
            'code',
            'data',
            'del',
            'dfn',
            'em',
            'font',
            'i',
            'img',
            'ins',
            'kbd',
            'map',
            'mark',
            'object',
            'q',
            'rp',
            'rt',
            'rtc',
            'ruby',
            's',
            'samp',
            'small',
            'span',
            'strike',
            'strong',
            'sub',
            'sup',
            'time',
            'tt',
            'u',
            'var',
        ],
    ];

    protected string $name;

    public ComponentSlot $slot;

    /**
     * @param  array<string,string>  $attributes
     */
    public function __construct(string $name, array $attributes = [], string $contents = '')
    {
        $this->name = strtolower($name);
        $this->withSlot($attributes, $contents);
    }

    /**
     * @param  array<string,string>  $attributes
     */
    public static function from(string $name, array $attributes = [], string $contents = ''): self
    {
        return new self($name, $attributes, $contents);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAttributes(): ComponentAttributeBag
    {
        return $this->slot->attributes;
    }

    /**
     * @param  array<string,string>  $attributes
     */
    public function withSlot(array $attributes, string $contents = ''): static
    {
        $this->slot = new ComponentSlot($contents, $attributes);

        return $this;
    }

    /**
     * @param  array<string,string>  $attributes
     */
    public function withAttributes(array $attributes): static
    {
        $this->slot->withAttributes($attributes);

        return $this;
    }

    public function isEmpty(): bool
    {
        return $this->slot->isEmpty();
    }

    public function isNotEmpty(): bool
    {
        return $this->slot->isNotEmpty();
    }

    public function isOrphan(): bool
    {
        return in_array($this->name, self::TAGS['orphan']);
    }

    public function isPaired(): bool
    {
        return ! $this->isOrphan();
    }

    public function isInline(): bool
    {
        return in_array($this->name, self::TAGS['inline']);
    }

    public function isBlock(): bool
    {
        return ! $this->isInline();
    }

    public function isCustom(): bool
    {
        return Str::contains($this->name, ['-', '.']);
    }

    public function contents(): string
    {
        return $this->slot->toHtml();
    }

    public function open(): string
    {
        return "<{$this->getName()} {$this->getAttributes()->toHtml()}".($this->isOrphan() ? '/>' : '>');
    }

    public function close(): string
    {
        return $this->isPaired() ? "</{$this->name}>" : '';
    }

    public function toHtml(): string
    {
        return $this->open().$this->contents().$this->close();
    }

    public function __toString(): string
    {
        return $this->toHtml();
    }
}
