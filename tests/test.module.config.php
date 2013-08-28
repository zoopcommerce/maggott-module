<?php

return [
    'zoop' => [
        'maggott' => [
            'exception_map' => [
                'Zoop\MaggottModule\Test\Asset\MappedException' => [
                    'described_by' => 'mapped-exception',
                    'title' => 'Mapped Exception',
                    'extra_fields' => ['publicInfo'],
                    'restricted_extra_fields' => ['restrictedInfo']
                ]
            ]
        ]
    ],

    'controllers' => [
        'invokables' => [
            'testController' => 'Zoop\MaggottModule\Test\Asset\TestController'
        ]
    ],

    'router' => [
        'routes' => [
            'test_exception' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/test_exception/:action',
                    'defaults' => [
                        'controller' => 'testController'
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . './view',
        ],
    ],
];
