<?php 

namespace SimpleApns\Lib;

class Config {


   private $urlProduction = 'https://api.push.apple.com/3/device/';

   private $urlDevelopment = 'https://api.sandbox.push.apple.com/3/device/';

   private $url;

   private $keyPath;

   private $buildId;

   private $secretKey;

   private $deviceToken;


   public function setEnv(bool $mode) {
       $this->url = $mode ? $this->urlProduction :  $this->urlDevelopment; 
       return $this;
   }

   public function setKeyPath(string $path) {
       $this->keyPath = file_exists($path) ? $path : '';
       return $this;
   }

   public function setSecretKey(string $key) {
       $this->secretKey = $key;
       return $this;
   }

   public function setBuildId(string $id) {
       $this->buildId = $id;
       return $this;
   }

   public function getConfig() {
       return [
           'secretKey' => $this->secretKey,
           'buildId'  => $this->buildId,
           'url' => $this->url,
           'keyPath' =>  $this->keyPath,
       ];
   }
   
   public function getHaders() {
       return [
        'apns-topic: '.$this->buildId,
        'apns-push-type: alert',
       ];
   }
}

