<?php

use Symfony\Component\HttpFoundation\RedirectResponse;

require 'bootstrap.php';

$transactionReference = isset($_SESSION['transactionReference']) ? $_SESSION['transactionReference'] : null;

if ($transactionReference === null) {
    (new RedirectResponse('/two-step/authorize.php'))->send();
}

$request = $gateway->completePurchase([
    'transactionReference' => $transactionReference,
    'MD' => $_REQUEST['MD'],
    'PaRes' => $_REQUEST['PaRes'],
]);

$response = $request->send();

if (!$response->isSuccessful()) {
    dd('complete purchase failure', $request->getData(), $response->getData());
}

echo 'Payment Succeed.';

dump($response->getData());
