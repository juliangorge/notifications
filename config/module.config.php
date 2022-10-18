<?php

declare(strict_types=1);

namespace Juliangorge\Notifications;

return [
    'controller_plugins' => [
        'factories' => [
            Plugin\Notifications::class => Plugin\Factory\NotificationsFactory::class,
        ],
        'aliases' => [
            'notifications' => Plugin\Notifications::class
        ]
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [ __DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],
];