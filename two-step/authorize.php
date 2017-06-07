<?php

use Omnipay\Common\CreditCard;
use Symfony\Component\HttpFoundation\RedirectResponse;

require 'bootstrap.php';

$card = new CreditCard(array(
    'firstName' => 'CARD',
    'lastName' => 'HOLDER',
    'number' => '4000000000000002',
    'expiryMonth' => 1,
    'expiryYear' => '2020',
    'cvv' => 362,
));

$request = $gateway->authorize([
    'transactionId' => time(),
    'clientIp' => $_SERVER['REMOTE_ADDR'],
    'amount' => '10.00',
    'card' => $card,
    'returnUrl' => getenv('URL') . '/two-step/complete-authorize.php',
]);

$response = $request->send();

if (!$response->isSuccessful()) {
    dd('authorize failure', $request->getData(), $response->getData());
}

$_SESSION['transactionReference'] = $response->getTransactionReference();

dump($response->getData());

echo '<a href="/two-step/capture.php">CAPTURE</a><br />';
echo '<a href="/two-step/void.php?transactionReference=' . $response->getTransactionReference() . '">VOID</a>';
