<?php

declare(strict_types=1);

namespace Juliangorge\Notifications\Controller;

class IndexController
{

    protected $em;
    protected $config;

    public function __construct($em, $config){
        $this->em = $em;
        $this->config = $config;
    }

    public function create(string $type, array $array){
        try {
            if($type == 'panel'){
                $entity = new \Juliangorge\Notifications\Entity\PanelNotification();
            }
            else{
                $entity = new \Juliangorge\Notifications\Entity\EmailNotification();
            }

            $entity->initialize($array);
            $this->em->persist();
            $this->flush();
        }
        catch(\Throwable $e){
            throw new \Exception($e->getMessage());
        }

        return true;
    }

    public function get(string $type, int $id){

    }

    public function getBy(string $type, array $array){

    }
}