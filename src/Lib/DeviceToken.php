<?php 

namespace SimpleApns\Lib;

class DeviceToken {
    private $deviceToken;

    public function setDeviceToken(string $token) {
        $this->deviceToken = $token;
        return $this;
    }

    public function getDeviceToken()  {
        return $this->deviceToken;
    }
}


