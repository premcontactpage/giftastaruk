<?php
exit;
require('config.php');

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    $final_status = $this->common_library->update_order($_SESSION['order_id'],$_POST['razorpay_payment_id']);
    unset($_SESSION['order_id']);
    unset($_SESSION['shopping_cart']);
    unset($_SESSION['shopping_cart_details']);
    unset($_SESSION['buyproduct']);
    $_SESSION['txn_id'] = $_POST['razorpay_payment_id'];

   ?>
   <script type="text/javascript">
       window.location.href='<?=base_url()?>success';
   </script>
<?php
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}


