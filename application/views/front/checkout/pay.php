<?php

require('config.php');
require('razorpay-php/Razorpay.php');

// Create the Razorpay Order

if(!isset($_SESSION['order_id']) && empty($_SESSION['order_id']))
{
   header('location'.base_url());
   exit;
}

$paid_amount = '';
$shipping = 90;
$payment = $this->common_library->fetch_paid_amount($_SESSION['order_id']);
if($payment[0]->paid_amount>0)
{
    $paid_amount = $payment[0]->paid_amount+$shipping;
}





use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);



//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
$orderData = [
    'receipt'         => 3456,
    'amount'          => $paid_amount * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];


$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'manual';
$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "JOYFULSURPRISES",
    "description"       => "",
    "image"             => "https://joyfulsurprises.in/assets/web/img/js-logo-brand.png",
    "prefill"           => [
    "name"              => "",
    "email"             => "",
    "contact"           => "",
    ],
    "notes"             => [
    "address"           => "Hello World",
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#21b6ea"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

require("checkout/{$checkout}.php");
