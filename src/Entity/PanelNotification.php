<?php
namespace Juliangorge\Notifications\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="panel_notifications", indexes={
    * @ORM\Index(name="active", columns={"active"}),
    * @ORM\Index(name="user_id", columns={"user_id"})
* })
*/
class PanelNotification
{
    /**
    * @ORM\Id
    * @ORM\Column(name="id", type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /** @ORM\Column(name="text", type="string") */
    protected $text;

    /** @ORM\Column(name="url", type="string", nullable=true) */
    protected $url;

    /** @ORM\Column(name="date", type="datetime") */
    protected $date;

    /** @ORM\Column(name="active", unique=false, type="boolean") */
    protected $active;

    /** @ORM\Column(name="user_id", unique=false, type="integer") */
    protected $user_id;

    public function getArrayCopy(){
        return [
            'id' => $this->id,
            'text' => $this->text,
            'url' => $this->url,
            'date' => $this->date,
            'active' => $this->active,
            'user_id' => $this->user_id,
        ];
    }

    public function initialize($array){
        $this->text = $array['text'];
        $this->url = $array['url'] == NULL ? '/notifications' : $array['url'];
        $this->date = new \DateTime();
        $this->active = 1;
        $this->user_id = $array['user_id'];
    }

    public function exchangeArray($array){
        $this->active = $array['active'];
    }

    public function getId(){ return $this->id; }
    public function getText(){ return $this->text; }
    public function getUrl(){ return $this->url; }
    public function getDate(){ return $this->date; }
    public function getActive(){ return $this->active; }
    public function getUserId(){ return $this->user_id; }

    public function setActive($v){ $this->active = $v; }
}
