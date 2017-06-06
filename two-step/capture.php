<?php

use Symfony\Component\HttpFoundation\RedirectResponse;

require 'bootstrap.php';

$transactionReference = isset($_SESSION['transactionReference']) ? $_SESSION['transactionReference'] : null;

if ($transactionReference === null) {
    (new RedirectResponse('/two-step/authorize.php'))->send();
}

$request = $gateway->capture([
    'transactionReference' => $transactionReference,
]);

$response = $request->send();

if (!$response->isSuccessful()) {
    dd('capture failure', $request->getData(), $response->getData());
}

echo 'Payment Succeed.';

dump($response->getData());