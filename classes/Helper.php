<?php

class Helper
{
    private static $clientId = "IKIA83BDD0B659E353A289D5AD5AD97936608DD75072";//to be moved
    private static $secretKey = "8q0S5VwkQ0vpWMA4RjEvnsFt5k2+EtzQ1fDb3WOE/48=";//to be moved
    private static $authorizationString;
    private static $nonce;
    private static $timeStamp;
    private static $signatureMethod = 'SHA1';
    private static $terminalId = '3DMO0001';
    
    public static function __constructStatic()
    {
        self::$authorizationString = self::computeAuthorizationString();
        self::$nonce = self::computeNonce();
        self::$timeStamp = self::computeTimeStamp();
    }
    
    public static function curl($method, $endpoint, $fields = [])
    {
        if (strtolower($method) === 'get') {
            $curlInit = curl_init();
            curl_setopt($curlInit, CURLOPT_URL, $endpoint);
            curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curlInit, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: ' . self::$authorizationString,
                'Signature: ' . self::computeSignature($endpoint),
                'TimeStamp: ' . self::$timeStamp,
                'Nonce: ' . self::$nonce,
                'TerminalID: ' . self::$terminalId,
                'SignatureMethod: ' . self::$signatureMethod

            ));
            $response = curl_exec($curlInit);
        }
        curl_close($curlInit);
        return $response;
    }

    public static function computeTimeStamp()
    {
        return time();
    }

    public static function computeNonce($length = 32)
    {
        $nonce = '';
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLenth = strlen($characters);
        for ($i = 0; $i < $length; $i++) {
            $nonce .= $characters[rand(0, $charactersLenth - 1)];
        }
        return $nonce;
    }

    public static function computeAuthorizationString()
    {
        return 'InterswitchAuth ' . base64_encode(self::$clientId);
    }

    public static function computeSignature($endpoint, $method = 'GET')
    {
        $signature = $method . '&' . urlencode($endpoint) . '&' . self::$timeStamp .
        '&' . self::$nonce . '&' . self::$clientId . '&' . self::$secretKey;
        $hashedSignature = base64_encode(pack('H*', sha1($signature)));
        return $hashedSignature;
    }
}

Helper::__constructStatic();