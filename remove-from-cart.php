<?php
include_once("functions.php");
session_start();

if (!isset($_SESSION["user"])) {
    echo "<script>location.href='login.php'</script>";
} else {
    $userid = $_SESSION["user"]["userid"];
}

if (isset($_GET["uid"]) && isset($_GET["pid"])) {
    $uid = $_GET["uid"];
    $pid = $_GET["pid"];
} else {
    echo "<script>location.href='cart.php'</script>";
}

$remove = mysqli_query($conn, "DELETE FROM `cart` WHERE `userid` = '$uid' AND `productid` = '$pid'");
if ($remove) {
    echo "<script>location.href='cart.php'; alert('Item removed from cart 🛒')</script>";
}

?>