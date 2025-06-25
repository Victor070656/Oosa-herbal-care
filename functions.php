<?php

include_once(__DIR__ . "/config.php");
include_once(__DIR__ . "/paystack_config.php");

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Matscode\Paystack\Transaction;

//Load Composer's autoloader
require __DIR__ . '/vendor/autoload.php';
// session_start();

$secKey = "sk_test_e3bb322135d48ff5c41900329e9aceade2dc7511";

function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

function sendMail($email, $subject, $body, $success = "Message has been sent")
{





    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'mail.comunityguidline.com.ng';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'info@comunityguidline.com.ng';                     //SMTP username
        $mail->Password = '@Admin2024';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('info@comunityguidline.com.ng', 'Oosa Herbal Care');
        $mail->addAddress($email);               //Name is optional


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;
        //        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo "<script>alert('$success')</script>";
        return true;
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }

}
function sendNotification($subject, $body)
{

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'tradeformefx.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'support@tradeformefx.com';                     //SMTP username
        $mail->Password = '@Admin2024';                               //SMTP password
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        // $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('support@tradeformefx.com', 'Oosa Herbal Care');
        $mail->addAddress("ikechukwuv052@gmail.com");               //Name is optional


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;
        //        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        // echo "<script>alert('$success')</script>";
        return true;
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }

}


function makePayment($email, $amount, $callback)
{
    global $secKey;
    $transaction = new Transaction($secKey);

    $response = $transaction
        ->setCallbackUrl($callback)
        ->setEmail($email)
        ->setAmount($amount)
        ->initialize();

    $_SESSION["ref"] = $response->reference;
    echo "<script>location.href = '" . $response->authorizationUrl . "'</script>";
    // Http::redirect($response->authorizationUrl);
}

function confirmTransaction($ref)
{
    global $secKey;

    $transaction = new Transaction($secKey);
    return $transaction->isSuccessful($ref);
}
