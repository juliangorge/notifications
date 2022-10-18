<?php
namespace Juliangorge\Notifications\Plugin\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class NotificationsFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new $requestedName(
            $container->get('doctrine.entitymanager.orm_default'),
            $container->get('config')
        );
    }
}