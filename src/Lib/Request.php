<?php

namespace SimpleApns\Lib;

use SimpleApns\Lib\Config; 
use SimpleApns\Lib\Message; 
use SimpleApns\Lib\DeviceToken; 

class Request {

    public static $response = [
        '0'   => 'Config issues.',

        '200' => 'Success.',

        '400' => 'Bad request.',

        '403' => 'There was an error with the certificate or with the provider’s authentication token.',

        '404' => 'The request contained an invalid :path value.',

        '405' => 'The request used an invalid :method value. Only POST requests are supported.',

        '410' => 'The device token is no longer active for the topic.',

        '413' => 'The notification payload was too large.',

        '429' => 'The server received too many requests for the same device token.',

        '500' => 'Internal server error.',

        '503' => 'The server is shutting down and unavailable.',
    ]; 
   
    public static function getResponse($httpcode) {
        $httpcode = isset(self::$responses[$httpcode]) ? $httpcode : 0;
        return [ 'response' => self::$response[$httpcode] , 'code' => $httpcode ];
    }

    public static function curlRequest(Config $config, Message $message, DeviceToken $deviceToken) {

        $url = $config->getURL().$deviceToken->getDeviceToken();

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $config->getHaders());
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message->getMessage()));
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2_0);

        curl_setopt($ch, CURLOPT_SSLCERT, $config->getKeyPath());
        curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $config->getsecretKey());

        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return self::getResponse($httpcode);
    } 
}
