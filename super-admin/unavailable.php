<?php
include_once "../config.php";
session_start();
if (!isset($_SESSION["admin"])) {
    echo "<script>location.href='login.php'</script>";
}

if (isset($_GET["pid"])) {
    $productid = $_GET["pid"];
} else {
    echo "<script>location.href='products.php'</script>";
}


$unavailable = mysqli_query($conn, "UPDATE `products` SET `status`='unavailable' WHERE `productid`='$productid' ");
if ($unavailable) {
    echo "<script>location.href='products.php'</script>";
}
