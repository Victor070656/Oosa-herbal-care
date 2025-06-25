<?php

// include_once("config.php");
include_once("functions.php");
session_start();

if (!isset($_SESSION["user"])) {
    echo "<script>location.href='login.php'</script>";
} else {
    $userid = $_SESSION["user"]["userid"];
    $email = $_SESSION["user"]["email"];
}

makePayment($email, (int)$_POST["amount"], "http://localhost/abl/pay.php");

// $url = "https://api.paystack.co/transaction/initialize";

// $fields = [
//     'email' => $email,
//     'amount' => $_POST["amount"] * 100, // Convert amount to kobo
//     'callback_url' => "http://localhost:18000/pay.php?msg=success",
//     'metadata' => ["cancel_action" => "http://localhost:18000/cart.php"]
// ];

// $fields_string = http_build_query($fields);

// //open connection
// $ch = curl_init();

// //set the url, number of POST vars, POST data
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//     "Authorization: Bearer $paystackSecretKey",
//     "Cache-Control: no-cache",
// ));

// //So that curl_exec returns the contents of the cURL; rather than echoing it
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// //execute post
// $result = curl_exec($ch);
// $response = json_decode($result, true);

// // Error handling
// if (curl_errno($ch)) {
//     echo 'Error:' . curl_error($ch);
// } elseif ($response['status'] !== true) {
//     echo 'Transaction Initialization Failed: ' . $response['message'];
// } else {
//     // Redirect to Paystack payment page
//     $authorization_url = $response['data']['authorization_url'];
//     //                         header('Location: ' . $authorization_url);
//     echo "<script>location.href='$authorization_url'</script>";
// }

// //close connection
// curl_close($ch);

