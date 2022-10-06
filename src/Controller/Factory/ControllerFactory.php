<?php
namespace Juliangorge\Notifications\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Juliangorge\Users\Service\AuthManager;

class ControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new $requestedName(
            $container->get('doctrine.entitymanager.orm_default'),
            $container->get('config')
        );
    }
}