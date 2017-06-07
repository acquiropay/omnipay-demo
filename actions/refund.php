<?php

require '../one-step/bootstrap.php';

$transactionReference = isset($_REQUEST['transactionReference']) ? $_REQUEST['transactionReference'] : null;
$amount = isset($_REQUEST['amount']) ? $_REQUEST['amount'] : null;

if ($transactionReference === null) {
    echo 'transactionReference is null';
    exit;
}

$options = compact('transactionReference', 'amount');

$request = $gateway->refund(compact('transactionReference', 'amount'));
$response = $request->send();

if(!$response->isSuccessful()) {
    dd('refund failure', $request->getData(), $response->getData());
}

echo 'Payment Refunded.';

dump($response->getData());

