<?php 

namespace SimpleApns\Lib;

class Message {

   private $title;

   private $body;

   private $sound = 'default';

   public function __construct(Array $message) {
       return $this->setTitle($message['title'])
                   ->setBody($message['body'])
                   ->setSound(isset($message['sound']) ? $message['sound'] : null);
   }

   public function setTitle(string $title) {
       $this->title = $title;
       return $this;
   }

   public function getTitle(string $title) {
       return $this->title;
   }

   public function setBody(string $body) {
       $this->body = $body;
       return $this;
   }

   public function getBody() {
       return $this->body;
   }

   public function setSound(string $sound = null) {
       if(!is_null($sound))
           $this->sound = $sound;
       return $this;
   }

   public function getSound(string $sound = null) {
       return $this->sound;
   }


   public function getMessage() {
       return [
           'aps' => [
               'alert' => [
                   'title' => $this->title,
                   'body' => $this->body,
               ],
               'sound' => $this->sound,
           ],
       ];
   }

}
