<?php

namespace Sigui\UI\Contracts;

use Illuminate\View\Component;

interface IsTemplateCompiler extends IsCompiler
{
    /**
     * Get the path currently being compiled.
     *
     * @return string
     */
    public function getPath();

    /**
     * Set the path currently being compiled.
     *
     * @param  string  $path
     * @return void
     */
    public function setPath($path);

    /**
     * Compile the given Blade template contents.
     *
     * @param  string  $value
     * @return string
     */
    public function compileString($value);

    /**
     * Evaluate and render a Blade string to HTML.
     *
     * @param  string  $string
     * @param  array  $data
     * @param  bool  $deleteCachedView
     * @return string
     */
    public static function render($string, $data = [], $deleteCachedView = false);

    /**
     * Render a component instance to HTML.
     *
     * @return string
     */
    public static function renderComponent(Component $component);
}
