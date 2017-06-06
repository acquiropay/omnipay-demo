<?php

session_start();

use Omnipay\Omnipay;

require '../bootstrap.php';

$gateway = Omnipay::create('AcquiroPay');
$gateway->setTestMode(true);
$gateway->setMerchantId(getenv('MERCHANT_ID'));
$gateway->setProductId(getenv('TWO_STEP_PRODUCT_ID'));
$gateway->setSecretWord(getenv('TWO_STEP_SECRET_WORD'));
