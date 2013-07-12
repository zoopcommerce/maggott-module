<?php

return [
    'zoop' => [
        'exception' => [
            'exceptionMap' => [
                'Zoop\MaggottModule\Test\Asset\MappedException' => [
                    'describedBy' => 'mapped-exception',
                    'title' => 'Mapped Exception',
                    'extensionFields' => ['publicInfo'],
                    'restrictedExtensionFields' => ['restrictedInfo']
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
];
