<?php

namespace Sikessem\UI\Contracts;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\ComponentAttributeBag;
use Stringable;

interface IsComponentTag extends Stringable, Htmlable
{
    public function getName(): string;

    public function getAttributes(): ComponentAttributeBag;

    /**
     * @param  array<string,string>  $attributes
     */
    public function withSlot(array $attributes, string $contents = ''): static;

    /**
     * @param  array<string,string>  $attributes
     */
    public function withAttributes(array $attributes): static;

    public function isEmpty(): bool;

    public function isNotEmpty(): bool;

    public function isOrphan(): bool;

    public function isPaired(): bool;

    public function isInline(): bool;

    public function isBlock(): bool;

    public function isCustom(): bool;

    public function contents(): string;

    public function open(): string;

    public function close(): string;
}
