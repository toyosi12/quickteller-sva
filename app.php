<?php
require_once 'autoload.php';
$billerId = 109;
$categoryId = 3;
$paymentCode = 10801;
// $getBillers = Sva::getBillers();
// $getBillerPaymentItems = Sva::getBillerPaymentItems($billerId);

$fields = array(
    'customerId' => '00000000001',
    'customerMobile' => '2348033115478',
    'customerEmail' => 'iswtester2@yahoo.com',
    'amount' => 146000,
    'paymentCode' => '10801',
    'requestReference' => 1453 . '' . time()
);

$customerFields = array(
    'customers' => [
        array('customerId' => '00000000001',
        'paymentCode' => '10801')
    ]
);


//print_r(SVA::queryTransaction(145308080808));