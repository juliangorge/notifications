<?php
namespace Juliangorge\Notifications;

use Laminas\Mvc\MvcEvent;
use Laminas\Mvc\Controller\AbstractActionController;

class Module 
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

}