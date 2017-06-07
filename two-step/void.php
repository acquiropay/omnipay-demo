<?php

require 'bootstrap.php';

$transactionReference = isset($_REQUEST['transactionReference']) ? $_REQUEST['transactionReference'] : null;

if ($transactionReference === null) {
    echo 'transactionReference is null';
    exit;
}

$request = $gateway->void([
    'transactionReference' => $transactionReference,
]);
$response = $request->send();

if(!$response->isSuccessful()) {
    dd('void failure', $request->getData(), $response->getData());
}

echo 'Void Succeed';