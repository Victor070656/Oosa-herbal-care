<?php
include_once("config.php");
session_start();

if (!isset($_SESSION["user"])) {
    echo "<script>location.href='login.php'</script>";
} else {
    $userid = $_SESSION["user"]["userid"];
}

if (isset($_GET["pid"])) {
    $productid = $_GET["pid"];
} else {
    echo "<script>location.href='./'</script>";
}


$checkWish = mysqli_query($conn, "SELECT * FROM `cart` WHERE `userid` = '$userid' AND `productid` = '$productid'");
if (mysqli_num_rows($checkWish) > 0) {
    $addToCart = mysqli_query($conn, "UPDATE `cart` SET `quantity`=(`quantity` + 1) WHERE `userid` = '$userid' AND `productid` = '$productid'");
    echo "<script>location.href='cart.php';alert('One additional product added to your cart 🛒')</script>";
} else {
    $addToCart = mysqli_query($conn, "INSERT INTO `cart` (`userid`, `productid`, `quantity`) VALUES ('$userid', '$productid', 1)");
    if ($addToCart) {
        echo "<script>location.href='cart.php';alert('Product added to your cart 🛒')</script>";
    }
}
