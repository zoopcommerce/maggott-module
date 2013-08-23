<?php
return [
    'zoop' => [
        'maggott' => [
            'enable_json_exception_strategy' => true,
            'description_route' => 'exception.description',
            'exception_map' => []
        ],
    ],

    'doctrine' => array(
        'driver' => array(
            'default' => array(
                'drivers' => array(
                    'Zoop\MaggottModule\DataModel' => 'doctrine.driver.exception'
                ),
            ),
            'exception' => array(
                'class' => 'Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver',
                'paths' => array(
                    __DIR__ . '/../src/Zoop/MaggottModule/DataModel'
                ),
            ),
        ),
    ),

    'router' => [
        'routes' => [
            'exception.descirption' => [
                //this route will return human readable informatino about exceptions
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/exception/:id',
                    'constraints' => [
                        'controller' => 'Zoop\MaggottModule\ExceptionDescriptionController',
                        'id'         => '[a-zA-Z][a-zA-Z0-9/_-]+',
                    ],
                    'defaults' => [
                        'extension'    => 'rest',
                        'manifestName' => 'default',
                    ]
                ],
            ],
        ]
    ],

    'controllers' => [
        'factory' => [
            'Zoop\MaggottModule\ExceptionDescriptionController' => 'Zoop\MaggottModule\Service\ExceptionDescriptionControllerFactory',
        ]
    ],

    'service_manager' => [
        'factories' => [
            'Zoop\MaggottModule\JsonExceptionStrategy' => 'Zoop\MaggottModule\Service\JsonExceptionStrategyFactory',
        ],
    ],

    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
