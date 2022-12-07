<?php
namespace Juliangorge\Notifications\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="email_notifications", indexes={
    * @ORM\Index(name="email", columns={"email"})
* })
*/
class EmailNotification
{
    /**
    * @ORM\Id
    * @ORM\Column(name="id", type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /** @ORM\Column(name="title", type="string") */
    protected $title;

    /** @ORM\Column(name="details", type="text") */
    protected $details;

    /** @ORM\Column(name="date", type="datetime") */
    protected $date;

    /** @ORM\Column(name="sent", type="boolean") */
    protected $sent;

    /** @ORM\Column(name="sent_date", type="datetime", nullable=true) */
    protected $sent_date;

    /** @ORM\Column(name="email", type="string") */
    protected $email;

    public function getArrayCopy(){
        return [
            'id' => $this->id,
            'title' => $this->title,
            'details' => $this->text,
            'date' => $this->date,
            'sent' => $this->sent,
            'email' => $this->email,
        ];
    }

    public function initialize($array){
        $this->title = $array['title'];
        $this->details = $array['details'];
        $this->date = new \DateTime();
        $this->sent = 0;
        $this->email = trim($array['email']);
    }

    public function sent(){
        $this->sent = 1;
        $this->sent_date = new \DateTime();
    }

    public function getId(){ return $this->id; }
    public function getTitle(){ return $this->title; }
    public function getDetails(){ return $this->details; }
    public function getDate(){ return $this->date; }
    public function getSent(){ return $this->sent; }
    public function getSentDate(){ return $this->sent_date; }
    public function getEmail(){ return $this->email; }

    public function setTitle($v){ $this->title = $v; }
    public function setDetails($v){ $this->details = $v; }
    public function setDate($v){ $this->date = $v; }
    public function setSent($v){ $this->sent = $v; }
    public function setSentDate($v){ $this->sent_date = $v; }
    public function setEmail($v){ $this->email = $v; }
    
}
