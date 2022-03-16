<?php 

namespace SimpleApns;

use SimpleApns\Lib\Config;
use SimpleApns\Lib\Message;
use SimpleApns\Lib\DeviceToken;
use SimpleApns\Lib\Request;

class Apns {


    public static function send($config, $message, $deviceToken) {
        return Request::curlRequest(new Config($config), new Message($message), new DeviceToken($deviceToken));
    } 

}
