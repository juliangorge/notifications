<?php
namespace Juliangorge\Notifications;

class Module 
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

}