<?php

return [
    'flash' => [
        'element' => 'p',
        'attributes' => [],
    ],
    'flashes' => [
        'element' => 'ul',
        'attributes' => [],
        'flash' => [
            'element' => 'li',
            'attributes' => [],
        ],
    ],

    'error' => [
        'element' => 'p',
        'attributes' => [],
    ],
    'errors' => [
        'element' => 'ul',
        'attributes' => [],
        'error' => [
            'element' => 'li',
            'attributes' => [],
        ],
    ],

    'icon' => [
        'element' => 'svg',
        'attributes' => [],
        'size' => 24,
        'width' => 24,
        'height' => 24,
        'fill' => 'currentColor',
    ],

    /*
     * Define custom component
     */
    'custom' => [
        'element' => 'custom-element',
        'attributes' => ['id' => 'myCustom', 'class' => 'my custom'],
        'slot' => 'My Content',
    ],
];
