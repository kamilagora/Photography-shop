<?php
require_once "../../settings.php";
require_once BASE_DIR . "/lib/PayPal/autoload.php";

if (!Me::IsLoggedIn()) {
    http_response_code(403);
    exit("Error: User not logged in");
}


use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

$apiContext = new ApiContext(
    new OAuthTokenCredential(
        PAYPAL_CLIENT,
        PAYPAL_SECRET
    )
);

$apiContext->setConfig([
    "mode" => PAYPAL_MODE
]);

// Create new payer and method
$payer = new Payer();
$payer->setPaymentMethod("paypal");

// Set redirect URLs
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl(PAYPAL_REDIRECT_SUCCESS)
    ->setCancelUrl(PAYPAL_REDIRECT_CANCEL);

$total = 0.0;
$order = [];

// Set item list
$item_list = new ItemList();

foreach (Cart::GetProducts() as $product) {
    $row = $product->GetData();

    $item = new Item();
    $item->setQuantity(1);
    $item->setPrice($row["price"]);
    $item->setCurrency("PLN");
    $item->setName($row["title"]);
    $item->setDescription($row["short_description"]);
    $item_list->addItem($item);

    $total += $row["price"];
    $order[] = $row["id"];
}

if ($total === 0.0) {
    http_response_code(401);
    exit("Error: Cart is empty");
}

// Set payment amount
$amount = new Amount();
$amount->setCurrency("PLN")
    ->setTotal($total);

$order_id = Order::Create(Me::GetUser()->GetData()["id"], $order);

if ($order_id < 1) {
    http_response_code(500);
    exit("Error: Failed to create order");
}

Cart::ClearCart();

// Set transaction object
$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setDescription("Photography store Order #$order_id")
    ->setCustom("$order_id")
    ->setItemList($item_list);

// Create the full payment object
$payment = new Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));

// Create payment with valid API context
try {
    $payment->create($apiContext);

    // Get PayPal redirect URL and redirect the customer
    $approvalUrl = $payment->getApprovalLink();

    // Redirect the customer to $approvalUrl
    header("Location: $approvalUrl");
} catch (PayPal\Exception\PayPalConnectionException $ex) {
    echo $ex->getCode();
    echo $ex->getData();
    die($ex);
} catch (Exception $ex) {
    die($ex);
}
