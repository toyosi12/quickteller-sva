<?php

class SVA
{
    public static function getBillers()
    {
        $endpoint = 'https://sandbox.interswitchng.com/api/v2/quickteller/billers';
        echo Helper::curl('GET', $endpoint);
        // echo Helper::computeSignature($endpoint);
    }
}