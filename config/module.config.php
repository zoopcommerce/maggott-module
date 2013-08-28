<?php
return [
    'zoop' => [
        'maggott' => [
            'enable_json_exception_strategy' => true,
            'description_route' => 'exception.description',
            'exception_map' => []
        ],
    ],

    'router' => [
        'routes' => [
            'exception.description' => [
                //this route will return human readable informatino about exceptions
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/exception/:id',
                    'constraints' => [
                        'id'     => '[a-zA-Z][a-zA-Z0-9/_-]+',
                    ],
                    'defaults' => [
                        'controller' => 'Zoop\MaggottModule\Controller\ExceptionDescriptionController',
                        'action' => 'index'
                    ]
                ],
            ],
        ]
    ],

    'controllers' => [
        'factories' => [
            'Zoop\MaggottModule\Controller\ExceptionDescriptionController' => 'Zoop\MaggottModule\Service\ExceptionDescriptionControllerFactory',
        ]
    ],

    'service_manager' => [
        'factories' => [
            'Zoop\MaggottModule\JsonExceptionStrategy' => 'Zoop\MaggottModule\Service\JsonExceptionStrategyFactory',
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
