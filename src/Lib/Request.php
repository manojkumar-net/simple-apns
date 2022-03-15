<?php

namespace SimpleApns\Lib;

class Request {

    public static $code = [
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

    public static function curlRequest(array $data) {

        $url = $data['config']['url'].$data['deviceToken'];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $data['headers']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data['message']));
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2_0);

        curl_setopt($ch, CURLOPT_SSLCERT, $data['config']['keyPath']);
        curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $data['config']['secretKey']);

        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $httpcode = isset(self::$responses[$httpcode]) ? $httpcode : 0;

        return [ 'response' =>  self::$code[$httpcode], 'code' => $httpcode];
    } 
}
