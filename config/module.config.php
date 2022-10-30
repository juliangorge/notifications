<?php

declare(strict_types=1);

namespace Juliangorge\Notifications;

return [
    'laminas-cli' => [
        'commands' => [
            'notifications:send_emails' => Scripts\EmailNotification::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            Scripts\EmailNotification::class => Scripts\Factory\CronScriptsFactory::class
        ],
    ],
    'controller_plugins' => [
        'factories' => [
            Plugin\NotificationsPlugin::class => Plugin\Factory\NotificationsPluginFactory::class,
        ],
        'aliases' => [
            'notifications' => Plugin\NotificationsPlugin::class
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