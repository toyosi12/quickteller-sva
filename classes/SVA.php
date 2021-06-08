<?php

class SVA
{
    public static function getBillers()
    {
        $endpoint = 'https://sandbox.interswitchng.com/api/v2/quickteller/billers';
        return Helper::curl('GET', $endpoint);
        // echo Helper::computeSignature($endpoint);
    }

    public static function getBillerCategories()
    {
        $endpoint = 'https://sandbox.interswitchng.com/api/v2/quickteller/categorys';
        return Helper::curl('GET', $endpoint);
    }

    public static function getBillersByCategory($categoryId)
    {
        $endpoint = 'https://sandbox.interswitchng.com/api/v2/quickteller/categorys/' . $categoryId . '/billers';
        return Helper::curl('GET', $endpoint);
    }

    public static function getBillerPaymentItems($billerId)
    {
        $endpoint = 'https://sandbox.interswitchng.com/api/v2/quickteller/billers/' . $billerId . '/paymentitems';
        return Helper::curl('GET', $endpoint);
    }

    public static function sendBillPaymentAdvice($fields)
    {
        $fields['terminalId'] = Helper::$terminalId;
        $endpoint = 'https://sandbox.interswitchng.com/api/v2/quickteller/payments/advices';
        return Helper::curl('POST', $endpoint, $fields);
    }

    public static function validateCustomer($fields)
    {
        $endpoint = 'https://sandbox.interswitchng.com/api/v2/quickteller/customers/validations';
        return Helper::curl('POST', $endpoint, $fields);
    }

    public static function queryTransaction($requestReference)
    {
        $endpoint = 'https://sandbox.interswitchng.com/api/v2/quickteller/transactions?requestreference=' . $requestReference;
        return Helper::curl('GET', $endpoint);
    }
}