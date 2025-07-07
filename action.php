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

makePayment($email, (int) $_POST["amount"], "http://localhost/abl/pay.php");

