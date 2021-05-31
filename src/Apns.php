<?php 

namespace SimpleApns;

use SimpleApns\Lib\Config;
use SimpleApns\Lib\Message;
use SimpleApns\Lib\DeviceToken;
use SimpleApns\Lib\Request;

class Apns {

    public static function send($config, $message, $deviceToken) {
        $data = [];
        $setConfig = (new Config)->setKeyPath($config['keyPath'])->setSecretKey($config['secretKey'])->setBuildId($config['buildId'])->setEnv($config['environment']);
        $data['config'] = $setConfig->getConfig();
        $data['headers'] = $setConfig->getHaders();
        $setMessage = (new Message)->setTitle($message['title'])->setBody($message['body'])->setSound(isset($message['sound']) ? $message['sound'] : null);
        $data['message'] = $setMessage->getMessage();
        $setDeviceToken = (new DeviceToken)->setDeviceToken($deviceToken);
        $data['deviceToken'] = $setDeviceToken->getDeviceToken();
        return (new Request)->curlRequest($data);
    }  

}
