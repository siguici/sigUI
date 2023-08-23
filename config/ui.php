<?php

return [
    'prefix' => 'ui',
    'components' => [
        /*
         * Define custom component
         */
        'custom' => [
            'tag' => 'custom-tag',
            'attributes' => ['id' => 'myCustom', 'class' => 'my custom'],
            'contents' => 'My Content',
        ],

        'button' => [
            'tag' => 'button',
            'attributes' => [],
            'variants' => [
                'image' => [
                    'attributes' => [
                        'type' => 'image',
                    ],
                ],
                'reset' => [
                    'attributes' => [
                        'type' => 'reset',
                    ],
                ],
                'submit' => [
                    'attributes' => [
                        'type' => 'submit',
                    ],
                ],
            ],
        ],

        'entry' => [
            'attributes' => [],
            'variants' => [
                'color' => [
                    'attributes' => [
                        'type' => 'color',
                    ],
                ],
                'date' => [
                    'attributes' => [
                        'type' => 'date',
                    ],
                ],
                'datetime-local' => [
                    'attributes' => [
                        'type' => 'datetime-local',
                    ],
                ],
                'email' => [
                    'attributes' => [
                        'type' => 'email',
                    ],
                ],
                'file' => [
                    'attributes' => [
                        'type' => 'file',
                    ],
                ],
                'month' => [
                    'attributes' => [
                        'type' => 'month',
                    ],
                ],
                'number' => [
                    'attributes' => [
                        'type' => 'number',
                    ],
                ],
                'password' => [
                    'attributes' => [
                        'type' => 'password',
                    ],
                ],
                'range' => [
                    'attributes' => [
                        'type' => 'range',
                    ],
                ],
                'search' => [
                    'attributes' => [
                        'type' => 'search',
                    ],
                ],
                'tel' => [
                    'attributes' => [
                        'type' => 'tel',
                    ],
                ],
                'text' => [
                    'attributes' => [
                        'type' => 'text',
                    ],
                ],
                'textarea' => [
                    'attributes' => [
                        'type' => 'textarea',
                    ],
                ],
                'time' => [
                    'attributes' => [
                        'type' => 'time',
                    ],
                ],
                'url' => [
                    'attributes' => [
                        'type' => 'url',
                    ],
                ],
                'week' => [
                    'attributes' => [
                        'type' => 'week',
                    ],
                ],
            ],
        ],

        'error' => [
            'tag' => 'p',
            'attributes' => [],
        ],

        'errors' => [
            'tag' => 'ul',
            'attributes' => [],
            'error' => [
                'tag' => 'li',
                'attributes' => [],
            ],
        ],

        'flash' => [
            'tag' => 'p',
            'attributes' => [],
            'variants' => [
                'error' => [
                    'attributes' => [
                        'icon' => '',
                        'color' => '',
                        'message' => '',
                    ],
                ],
                'info' => [
                    'attributes' => [
                        'icon' => '',
                        'color' => '',
                        'message' => '',
                    ],
                ],
                'notice' => [
                    'attributes' => [
                        'icon' => '',
                        'color' => '',
                        'message' => '',
                    ],
                ],
                'ok' => [
                    'attributes' => [
                        'icon' => '',
                        'color' => '',
                        'message' => '',
                    ],
                ],
                'warning' => [
                    'attributes' => [
                        'icon' => '',
                        'color' => '',
                        'message' => '',
                    ],
                ],
            ],
        ],

        'flashes' => [
            'tag' => 'ul',
            'attributes' => [],
            'child' => [
                'tag' => 'li',
                'attributes' => [],
            ],
        ],

        'form' => [
            'tag' => 'form',
        ],

        'icon' => [
            'attributes' => [
                'tag' => 'svg',
                'size' => 24,
                'width' => 24,
                'height' => 24,
                'fill' => 'currentColor',
            ],
            'variants' => [
                'i' => [
                    'attributes' => [
                        'tag' => 'i',
                    ],
                ],
                'img' => [
                    'attributes' => [
                        'tag' => 'img',
                    ],
                ],
                'svg' => [
                    'attributes' => [
                        'tag' => 'svg',
                    ],
                ],
            ],
        ],

        'input' => [
            'tag' => 'input',
            'attributes' => [
                'type' => 'text',
            ],
            'variants' => [
                'button' => [
                    'attributes' => [
                        'type' => 'button',
                    ],
                ],
                'checkbox' => [
                    'attributes' => [
                        'type' => 'checkbox',
                    ],
                ],
                'color' => [
                    'attributes' => [
                        'type' => 'color',
                    ],
                ],
                'date' => [
                    'attributes' => [
                        'type' => 'date',
                    ],
                ],
                'datetime-local' => [
                    'attributes' => [
                        'type' => 'datetime-local',
                    ],
                ],
                'email' => [
                    'attributes' => [
                        'type' => 'email',
                    ],
                ],
                'file' => [
                    'attributes' => [
                        'type' => 'file',
                    ],
                ],
                'hidden' => [
                    'attributes' => [
                        'type' => 'hidden',
                    ],
                ],
                'image' => [
                    'attributes' => [
                        'type' => 'image',
                    ],
                ],
                'month' => [
                    'attributes' => [
                        'type' => 'month',
                    ],
                ],
                'number' => [
                    'attributes' => [
                        'type' => 'number',
                    ],
                ],
                'password' => [
                    'attributes' => [
                        'type' => 'password',
                    ],
                ],
                'radio' => [
                    'attributes' => [
                        'type' => 'radio',
                    ],
                ],
                'range' => [
                    'attributes' => [
                        'type' => 'range',
                    ],
                ],
                'reset' => [
                    'attributes' => [
                        'type' => 'reset',
                    ],
                ],
                'search' => [
                    'attributes' => [
                        'type' => 'search',
                    ],
                ],
                'submit' => [
                    'attributes' => [
                        'type' => 'submit',
                    ],
                ],
                'tel' => [
                    'attributes' => [
                        'type' => 'tel',
                    ],
                ],
                'text' => [
                    'attributes' => [
                        'type' => 'text',
                    ],
                ],
                'time' => [
                    'attributes' => [
                        'type' => 'time',
                    ],
                ],
                'url' => [
                    'attributes' => [
                        'type' => 'url',
                    ],
                ],
                'week' => [
                    'attributes' => [
                        'type' => 'week',
                    ],
                ],
            ],
        ],

        'label' => [
            'tag' => 'label',
            'attributes' => [],
        ],

        'link' => [
            'tag' => 'a',
            'attributes' => [],
        ],

        'menu' => [
            'tag' => 'ul',
            'attributes' => [],
            'child' => [
                'tag' => 'li',
                'attributes' => [],
            ],
        ],

        'select' => [
            'tag' => 'select',
            'attributes' => [],
            'child' => [
                'tag' => 'option',
                'attributes' => [],
            ],
        ],

        'text' => [
            'attributes' => [
                'escape' => false,
                'translate' => false,
            ],

            'variants' => [
                'escape' => [
                    'attributes' => [
                        'escape' => true,
                    ],
                ],
                'translate' => [
                    'attributes' => [
                        'translate' => true,
                    ],
                ],
            ],
        ],

        'textarea' => [
            'tag' => 'textarea',
            'attributes' => [],
        ],
    ],
];
