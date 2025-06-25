<?php
include_once("functions.php");
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

$checkWish = mysqli_query($conn, "SELECT * FROM `wish` WHERE `userid` = '$userid' AND `productid` = '$productid'");
if (mysqli_num_rows($checkWish) > 0) {
    echo "<script>location.href='./';alert('Product already added to your wishlist')</script>";
} else {
    $addToWish = mysqli_query($conn, "INSERT INTO `wish` (`userid`, `productid`) VALUES ('$userid', '$productid')");
    if ($addToWish) {
        echo "<script>location.href='./';alert('Product added to your wishlist 🖤')</script>";
    }
}
