<?php

namespace Sikessem\UI\Contracts;

interface IsComponentCompiler
{
    /**
     * Compile the component and slot tags within the given string.
     *
     * @return string
     */
    public function compile(string $value);

    /**
     * Compile the tags within the given string.
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function compileTags(string $value);

    /**
     * Get the component class for a given component alias.
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function componentClass(string $component);

    /**
     * Find the class for the given component using the registered namespaces.
     *
     * @return string|null
     */
    public function findClassByComponent(string $component);

    /**
     * Guess the class name for the given component.
     *
     * @return string
     */
    public function guessClassName(string $component);

    /**
     * Format the class name for the given component.
     *
     * @return string
     */
    public function formatClassName(string $component);

    /**
     * Guess the view name for the given component.
     *
     * @param  string  $name
     * @param  string  $prefix
     * @return string
     */
    public function guessViewName($name, $prefix = 'components.');

    /**
     * Partition the data and extra attributes from the given array of attributes.
     *
     * @param  string  $class
     * @return array
     */
    public function partitionDataAndAttributes($class, array $attributes);

    /**
     * Compile the slot tags within the given string.
     *
     * @return string
     */
    public function compileSlots(string $value);

    /**
     * Strip any quotes from the given string.
     *
     * @return string
     */
    public function stripQuotes(string $value);
}
