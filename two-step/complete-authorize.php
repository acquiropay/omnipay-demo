<?php

use Symfony\Component\HttpFoundation\RedirectResponse;

require 'bootstrap.php';

$transactionReference = isset($_SESSION['transactionReference']) ? $_SESSION['transactionReference'] : null;

if ($transactionReference === null) {
    (new RedirectResponse('/two-step/authorize.php'))->send();
}

$request = $gateway->completeAuthorize([
    'transactionReference' => $transactionReference,
    'MD' => $_REQUEST['MD'],
    'PaRes' => $_REQUEST['PaRes'],
]);

$response = $request->send();

if (!$response->isSuccessful()) {
    dd('complete authorize failure', $request->getData(), $response->getData());
}

(new RedirectResponse('/two-step/capture.php'))->send();

