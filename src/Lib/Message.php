<?php 

namespace SimpleApns\Lib;

class Message {

   private $title;

   private $body;

   private $sound = 'default';

   public function setTitle(string $title) {
       $this->title = $title;
       return $this;
   }

   public function setBody(string $body) {
       $this->body = $body;
       return $this;
   }

   public function setSound(string $sound = null) {
       if(!is_null($sound))
           $this->sound = $sound;
       return $this;
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
