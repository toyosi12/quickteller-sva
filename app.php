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


print_r(SVA::getBanks());

// $amount = 100000;
// $currencyCode = 566;
// $initiatingPaymentMethodCode = 'CA';
// $terminatingPaymentMethodCode = 'AC';
// $countryCode = 'NG';
// $beneficiaryLastName = "John";
// $beneficiaryFirstName = "Doe";
// $senderLastName = 'Oyelayo';
// $senderFirstName = 'Toyosi';
// $mac = hash('sha512', $amount . $currencyCode . $initiatingPaymentMethodCode . $amount . $currencyCode . $terminatingPaymentMethodCode . $countryCode);

// $fields = array(
//     'mac' => $mac,
//     'beneficiary' => array(
//             'lastname' => 'Anari',
//             'othernames' => 'Sammy',
//         ),

//     'initiatingEntityCode' => 'DMO',
//     'initiation' => array(
//             'amount' => $amount,
//             'channel' => 7,
//             'currencyCode' => $currencyCode,
//             'paymentMethodCode' => $initiatingPaymentMethodCode,
//         ),

//     'sender' => array(
//             'email' => 'simon.mokhele@hellogroup.co.za',
//             'lastname' => 'Testing',
//             'othernames' => 'Test',
//             'phone' => 0732246413,
//         ),

//     'termination' => array(
//             'accountReceivable' => array(
//                     'accountNumber' => '0698784016',
//                     'accountType' => 10,
//                 ),

//             'amount' => 100000,
//             'countryCode' => $countryCode,
//             'currencyCode' => $currencyCode,
//             'entityCode' => '058',
//             'paymentMethodCode' => $terminatingPaymentMethodCode,
//             ),

//     'transferCode' => 1453 . '' . time()
//         );



// print_r(SVA::doTransfer($fields));