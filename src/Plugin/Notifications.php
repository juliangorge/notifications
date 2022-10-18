<?php
namespace Juliangorge\Notifications\Plugin;

use Laminas\Mvc\Controller\Plugin\AbstractPlugin;

class Notifications extends AbstractPlugin 
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
            $this->em->persist($entity);
            $this->em->flush();
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