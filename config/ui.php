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

    /*
     * Define custom component
     */
    'custom' => [
        'element' => 'custom-element',
        'attributes' => ['id' => 'myCustom', 'class' => 'my custom'],
        'slot' => 'My Content',
    ],
];
