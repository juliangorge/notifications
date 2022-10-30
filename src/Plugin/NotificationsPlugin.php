<?php
namespace Juliangorge\Notifications\Plugin;

use Laminas\Mvc\Controller\Plugin\AbstractPlugin;
use Juliangorge\Notifications\Entity\PanelNotification;
use Juliangorge\Notifications\Entity\EmailNotification;

class NotificationsPlugin extends AbstractPlugin 
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
                $entity = new PanelNotification();
            }
            else{
                $entity = new EmailNotification();
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

    public function sendPendingMails(){
        $mail = new \Juliangorge\Mail\Mail($this->config);
        $entities = $this->em->getRepository(EmailNotification::class)->findBy([
            'sent' => false
        ]);

        $results = [
            'sent' => 0,
            'errors' => []
        ];

        foreach($entities as $entity){
            $success = true;
            try{
                $mail->send($entity->getEmail(), $entity->getTitle(), $entity->getDetails(), true);
            }
            catch(\Throwable $e){
                $results['errors'][] = $e->getMessage();
                $success = false;
            }

            if($success){
                $entity->sent();
                $this->em->flush();
                $results['sent']++;
            }
        }

        return $results;
    }

    public function get(string $type, int $id){

    }

    public function getBy(string $type, array $array){

    }

    public function getActivesByUserId(int $user_id){
        return $this->em->createQuery('SELECT p FROM ' . PanelNotification::class . ' p WHERE p.active = 1 AND p.user_id = :user_id')
        ->setParameter('user_id', $user_id)
        ->getArrayResult();
    }

}