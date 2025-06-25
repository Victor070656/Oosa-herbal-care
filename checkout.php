<?php
include_once("functions.php");
session_start();

if (!isset($_SESSION["user"])) {
    echo "<script>location.href='login.php'</script>";
} else {
    $userid = $_SESSION["user"]["userid"];
}
//dd($_POST);
if ($_POST) {
    $info = $_POST;
} else {
    echo "<script>location.href='cart.php'</script>";
}
$items = json_decode($info["items"], true);
$amount = $info["amount"];
//dd($items);

$subtotal = 0;
$discount = 0;
$total = 0;
$shipping = 0;
foreach ($items as $item) {
    // dd($item);
    $productid = $item["productid"];
    $getProduct = mysqli_query($conn, "SELECT * FROM `products` WHERE `productid` = '$productid'");
    $product = mysqli_fetch_assoc($getProduct);
    $product["price"] *= $item["quantity"];

    $diff = $product["price"] - ($product["price"] * ($product["discount"] / 100));
    $d = $product["price"] - $diff;

    $subtotal += $diff;
    $discount += $d;
    $total += $product["price"];
}
if ($total <= 20000) {
    $shipping = 1500;
} elseif ($total <= 5000) {
    $shipping = 2500;
} else {
    $shipping = 5000;
}
$topay = $subtotal + $shipping;

?>
<!doctype html>
<html lang="en" class="no-js">


<!-- Mirrored from spreethemesprevious.github.io/bisum/html/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 May 2024 11:37:56 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <title>Oosa Herbal Care || Checkout</title>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Oosa Herbal Care">
    <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <!-- all css -->
    <style>
        :root {
            --primary-color: #2e7d32;
            --secondary-color: #2e7d32;

            --btn-primary-border-radius: 0.25rem;
            --btn-primary-color: #fff;
            --btn-primary-background-color: #2e7d32;
            --btn-primary-border-color: #2e7d32;
            --btn-primary-hover-color: #fff;
            --btn-primary-background-hover-color: #2e7d32;
            --btn-primary-border-hover-color: #2e7d32;
            --btn-primary-font-weight: 500;

            --btn-secondary-border-radius: 0.25rem;
            --btn-secondary-color: #2e7d32;
            --btn-secondary-background-color: transparent;
            --btn-secondary-border-color: #2e7d32;
            --btn-secondary-hover-color: #fff;
            --btn-secondary-background-hover-color: #2e7d32;
            --btn-secondary-border-hover-color: #2e7d32;
            --btn-secondary-font-weight: 500;

            --heading-color: #000;
            --heading-font-family: 'Poppins', sans-serif;
            --heading-font-weight: 700;

            --title-color: #000;
            --title-font-family: 'Poppins', sans-serif;
            --title-font-weight: 400;

            --body-color: #000;
            --body-background-color: #fff;
            --body-font-family: 'Poppins', sans-serif;
            --body-font-size: 14px;
            --body-font-weight: 400;

            --section-heading-color: #000;
            --section-heading-font-family: 'Poppins', sans-serif;
            --section-heading-font-size: 48px;
            --section-heading-font-weight: 600;

            --section-subheading-color: #000;
            --section-subheading-font-family: 'Poppins', sans-serif;
            --section-subheading-font-size: 16px;
            --section-subheading-font-weight: 400;
        }
    </style>

    <link rel="stylesheet" href="assets/css/vendor.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="body-wrapper">
        <!-- include header.php -->
        <?php
        include("components/header.php");
        ?>
        <!-- include header.php end -->


        <!-- breadcrumb start -->
        <div class="breadcrumb">
            <div class="container">
                <ul class="list-unstyled d-flex align-items-center m-0">
                    <li><a href="/">Home</a></li>
                    <li>
                        <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.4">
                                <path
                                    d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z"
                                    fill="#000" />
                            </g>
                        </svg>
                    </li>
                    <li>Cart</li>
                    <li>
                        <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.4">
                                <path
                                    d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z"
                                    fill="#000" />
                            </g>
                        </svg>
                    </li>
                    <li>Checkout</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <main id="MainContent" class="content-for-layout">
            <div class="checkout-page mt-100">
                <div class="container">
                    <div class="checkout-page-wrapper">
                        <form method="post" action="pay.php">
                            <div class="row">
                                <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                                    <div class="section-header mb-3">
                                        <h2 class="section-heading">Check out</h2>
                                    </div>

                                    <div class="shipping-address-area">
                                        <h2 class="shipping-address-heading pb-1">Shipping address</h2>
                                        <div class="shipping-address-form-wrapper">
                                            <div class="shipping-address-form common-form">
                                                <div class="row">
                                                    <textarea name="items"
                                                        hidden="hidden"><?= $info["items"]; ?></textarea>
                                                    <input type="hidden" name="amount" value="<?= $topay; ?>" />
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <fieldset>
                                                            <label class="label">First name
                                                                <input type="text" name="first-name" required />
                                                            </label>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <fieldset>
                                                            <label class="label">Last name
                                                                <input type="text" name="last-name" required />
                                                            </label>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <fieldset>
                                                            <label class="label">Email address
                                                                <input type="email" name="email" required />
                                                            </label>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <fieldset>
                                                            <label class="label">Phone number
                                                                <input type="text" name="phone" required />
                                                            </label>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <fieldset>
                                                            <label class="label">Country
                                                                <input type="text" name="country" required />
                                                            </label>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <fieldset>
                                                            <label class="label">City
                                                                <input type="text" name="city" required />
                                                            </label>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <fieldset>
                                                            <label class="label">Zip code
                                                                <input type="text" name="zip" required />
                                                            </label>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <fieldset>
                                                            <label class="label">Address 1
                                                                <input type="text" name="addr1" required />
                                                            </label>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <fieldset>
                                                            <label class="label">Address 2
                                                                <input type="text" name="addr2" />
                                                            </label>
                                                        </fieldset>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                                    <div class="cart-total-area checkout-summary-area">
                                        <h3 class="d-none d-lg-block mb-0 text-center heading_24 mb-4">Order summary
                                        </h3>

                                        <div class="cart-total-box mt-4">
                                            <div class="subtotal-item subtotal-box">
                                                <h4 class="subtotal-title">Amount:</h4>
                                                <p class="subtotal-value">₦<?= $total; ?></p>
                                            </div>
                                            <div class="subtotal-item discount-box">
                                                <h4 class="subtotal-title">Discount:</h4>
                                                <p class="subtotal-value">₦<?= $discount; ?></p>
                                            </div>
                                            <div class="subtotal-item subtotal-box">
                                                <h4 class="subtotal-title">Subtotals:</h4>
                                                <p class="subtotal-value">₦<?= $subtotal; ?></p>
                                            </div>
                                            <div class="subtotal-item shipping-box">
                                                <h4 class="subtotal-title">Shipping:</h4>
                                                <p class="subtotal-value">₦<?= $shipping; ?></p>
                                            </div>

                                            <hr />
                                            <div class="subtotal-item discount-box">
                                                <h4 class="subtotal-title">Total:</h4>
                                                <p class="subtotal-value">₦<?= $topay; ?></p>
                                            </div>
                                            <p class="shipping_text">Shipping & taxes calculated at checkout</p>
                                            <div class="d-flex justify-content-center mt-4">

                                                <?php
                                                $a = "";
                                                $a = json_encode($items);
                                                ?>

                                                <input type="submit" value="Proceed to Pay"
                                                    class="position-relative btn-primary text-uppercase">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <!-- include footer -->
        <?php
        include("components/footer.php");
        ?>
        <!-- include footer end -->


        <!-- all js -->
        <script src="assets/js/vendor.js"></script>
        <script src="assets/js/main.js"></script>
    </div>
</body>


<!-- Mirrored from spreethemesprevious.github.io/bisum/html/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 May 2024 11:37:57 GMT -->

</html>