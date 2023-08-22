<?php

namespace Sikessem\UI\Contracts;

interface IsBladeComponent extends IsComponent
{
    /**
     * Get the view / view contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\Support\Htmlable|\Closure|string
     */
    public function render();

    /**
     * Resolve the Blade view or view file that should be used when rendering the component.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\Support\Htmlable|\Closure|string
     */
    public function resolveView();

    /**
     * Get the data that should be supplied to the view.
     *
     * @return array
     */
    public function data();

    /**
     * Set the component alias name.
     *
     * @param  string  $name
     * @return $this
     */
    public function withName($name);

    /**
     * Set the extra attributes that the component should make available.
     *
     * @return $this
     */
    public function withAttributes(array $attributes);

    /**
     * Determine if the component should be rendered.
     *
     * @return bool
     */
    public function shouldRender();

    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string|null  $view
     * @param  \Illuminate\Contracts\Support\Arrayable|array  $data
     * @param  array  $mergeData
     * @return \Illuminate\Contracts\View\View
     */
    public function view($view, $data = [], $mergeData = []);
}
