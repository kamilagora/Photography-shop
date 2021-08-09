<?php
require_once "../settings.php";
require_once BASE_DIR . "/lib/PayPal/autoload.php";

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

$apiContext = new ApiContext(
    new OAuthTokenCredential(
        PAYPAL_CLIENT,
        PAYPAL_SECRET
    )
);

$apiContext->setConfig([
    "mode" => PAYPAL_MODE
]);

// Get payment object by passing paymentId
$paymentId = $_GET['paymentId'];
$payment = Payment::get($paymentId, $apiContext);
$payerId = $_GET['PayerID'];

// Execute payment with payer ID
$execution = new PaymentExecution();
$execution->setPayerId($payerId);

try {
    // Execute payment
    $result = $payment->execute($execution, $apiContext);
    exit("Zamówienie w realizacji...");
} catch (PayPal\Exception\PayPalConnectionException $ex) {
    echo $ex->getCode();
    echo $ex->getData();
    die($ex);
} catch (Exception $ex) {
    die($ex);
}
