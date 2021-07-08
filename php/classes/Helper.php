<?php

class Helper
{
    private static $clientId = "IKIA83BDD0B659E353A289D5AD5AD97936608DD75072";//to be moved
    private static $secretKey = "8q0S5VwkQ0vpWMA4RjEvnsFt5k2+EtzQ1fDb3WOE/48=";//to be moved
    private static $authorizationString;
    private static $nonce;
    private static $timeStamp;
    private static $signatureMethod = 'SHA1';
    public static $terminalId = '3DMO0001';
    
    public static function __constructStatic()
    {
        self::$authorizationString = self::computeAuthorizationString();
        self::$timeStamp = self::computeTimeStamp();
    }
    
    public static function curl($method, $endpoint, $fields = [])
    {
        self::$nonce = self::computeNonce();
        $curlInit = curl_init();
        curl_setopt($curlInit, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: ' . self::$authorizationString,
            'Signature: ' . self::computeSignature($method, $endpoint),
            'TimeStamp: ' . self::$timeStamp,
            'Nonce: ' . self::$nonce,
            'TerminalID: ' . self::$terminalId,
            'SignatureMethod: ' . self::$signatureMethod

        ));

        curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlInit, CURLOPT_URL, $endpoint);

        if (strtoupper($method) === 'POST') {
            $fieldsString = json_encode($fields);
            curl_setopt($curlInit, CURLOPT_POST, true);
            curl_setopt($curlInit, CURLOPT_POSTFIELDS, $fieldsString);
        }
        
        $response = curl_exec($curlInit);
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

    /**
     * This method is deprecated
     */
    public static function generateRequestReference($length = 6)
    {
        $reference = '';
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLenth = strlen($characters);
        for ($i = 0; $i < $length; $i++) {
            $reference .= $characters[rand(0, $charactersLenth - 1)];
        }
        return $reference;
    }

    public static function computeAuthorizationString()
    {
        return 'InterswitchAuth ' . base64_encode(self::$clientId);
    }

    public static function computeSignature($method, $endpoint)
    {
        $method = strtoupper($method);
        $signature = $method . '&' . urlencode($endpoint) . '&' . self::$timeStamp .
        '&' . self::$nonce . '&' . self::$clientId . '&' . self::$secretKey;
        $hashedSignature = base64_encode(sha1($signature, true));
        return $hashedSignature;
    }
}

Helper::__constructStatic();