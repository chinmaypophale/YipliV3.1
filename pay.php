<?php
$product_name = $_POST["product_name"];
$name = $_POST["name"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$address = $_POST["address"];
$address2 = $_POST["address2"];
$zip = $_POST["zip"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$qty = $_POST["qty"];
$mobileno = $_POST["mobileno"];
$price = qty * 1200;


include 'src/instamojo.php';

// --------------------paste private key and auth -----------------------

$api = new Instamojo\Instamojo('test_970d7fe71401265cfc5cab91101', 'test_4a49447946d2ca6088fb5410778','https://test.instamojo.com/api/1.1/');


try {
    $response = $api->paymentRequestCreate(array(
        "purpose" => $product_name,
        "amount" => $price,
        "buyer_name" => $name,
        "phone" => $phone,
        "send_email" => true,
        "send_sms" => true,
        "email" => $email,
        'allow_repeated_payments' => false,
        "redirect_url" => "http://dexterlabs.co.in/checkrahul/thankyou.php",
        "webhook" => "http://dexterlabs.co.in/checkrahul/webhook.php"
        ));
    //print_r($response);

    $pay_ulr = $response['longurl'];

    //Redirect($response['longurl'],302); //Go to Payment page

    header("Location: $pay_ulr");
    exit();

}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}
  ?>
