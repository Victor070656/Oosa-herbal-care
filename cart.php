<?php
include_once("functions.php");
session_start();

if (!isset($_SESSION["user"])) {
    echo "<script>location.href='login.php'</script>";
} else {
    $userid = $_SESSION["user"]["userid"];
}
global $conn;

$checkCart = mysqli_query($conn, "SELECT `userid`, `productid`, `quantity` FROM `cart` WHERE `userid` = '$userid' ");
if (mysqli_num_rows($checkCart) > 0) {
    $items = mysqli_fetch_all($checkCart, MYSQLI_ASSOC);
}
// dd($items);

?>
<!doctype html>
<html lang="en" class="no-js">




<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
    <title>Oosa Herbal Care | Cart</title>
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
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <main id="MainContent" class="content-for-layout">
            <div class="cart-page mt-100">
                <div class="container">
                    <?php
                    if (mysqli_num_rows($checkCart) > 0) {
                        ?>
                        <div class="cart-page-wrapper">
                            <div class="row">
                                <div class="col-lg-7 col-md-12 col-12">
                                    <table class="cart-table w-100">
                                        <thead>
                                            <tr>
                                                <th class="cart-caption heading_18">Product</th>
                                                <th class="cart-caption heading_18"></th>
                                                <th class="cart-caption text-center heading_18 d-none d-md-table-cell">
                                                    Quantity</th>
                                                <th class="cart-caption text-end heading_18">Price</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $subtotal = 0;
                                            $discount = 0;
                                            $total = 0;
                                            $shipping = 0;
                                            $payment_total = 0;
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
                                                ?>

                                                <tr class="cart-item">
                                                    <td class="cart-item-media">
                                                        <div class="mini-img-wrapper">
                                                            <img class="mini-img" src="uploads/<?= $product["image"]; ?>"
                                                                alt="img">
                                                        </div>
                                                    </td>
                                                    <td class="cart-item-details">
                                                        <h2 class="product-title"><a
                                                                href="product.php?pid=<?= $product['productid']; ?>"><?= $item["quantity"] . " " . $product["name"]; ?>
                                                            </a></h2>
                                                        <p class="product-vendor"><?= $product["tags"]; ?></p>
                                                    </td>
                                                    <td class="cart-item-quantity">
                                                        <a href="remove-from-cart.php?uid=<?= $item['userid']; ?>&pid=<?= $item['productid']; ?>"
                                                            class="product-remove mt-2">Remove</a>
                                                    </td>
                                                    <td class="cart-item-price text-end">
                                                        <div class="product-price">₦<?= $diff; ?></div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }

                                            if ($total <= 20000) {
                                                $shipping = 1500;
                                            } elseif ($total <= 5000) {
                                                $shipping = 2500;
                                            } else {
                                                $shipping = 5000;
                                            }
                                            $payment_total = $subtotal + $shipping;
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-5 col-md-12 col-12">
                                    <div class="cart-total-area">
                                        <h3 class="cart-total-title d-none d-lg-block mb-0">Cart Totals</h3>
                                        <div class="cart-total-box mt-4">
                                            <div class="subtotal-item subtotal-box">
                                                <h4 class="subtotal-title">Amount:</h4>
                                                <p class="subtotal-value">₦<?= $total; ?></p>
                                            </div>
                                            <div class="subtotal-item subtotal-box">
                                                <h4 class="subtotal-title">Subtotals:</h4>
                                                <p class="subtotal-value">₦<?= $subtotal; ?></p>
                                            </div>
                                            <div class="subtotal-item discount-box">
                                                <h4 class="subtotal-title">Discount:</h4>
                                                <p class="subtotal-value">₦<?= $discount; ?></p>
                                            </div>
                                            <div class="subtotal-item shipping-box">
                                                <h4 class="subtotal-title">Shipping:</h4>
                                                <p class="subtotal-value">₦<?= $shipping; ?></p>
                                            </div>

                                            <hr />
                                            <div class="subtotal-item discount-box">
                                                <h4 class="subtotal-title">Total:</h4>
                                                <p class="subtotal-value">₦<?= $payment_total; ?></p>
                                            </div>
                                            <p class="shipping_text">Shipping & taxes calculated at checkout</p>
                                            <div class="d-flex justify-content-center mt-4">

                                                <form method="post" action="checkout.php">
                                                    <?php
                                                    $a = "";
                                                    $a = json_encode($items);
                                                    ?>
                                                    <textarea name="items" hidden="hidden"><?= $a; ?></textarea>
                                                    <input type="hidden" name="amount" value="<?= $payment_total; ?>">
                                                    <input type="submit" value="Proceed to checkout"
                                                        class="position-relative btn-primary text-uppercase">
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="card" style="border-radius: 15px">
                            <div class="card-body d-flex justify-content-center" style="min-height: 200px; ">
                                <div class="my-auto text-center">
                                    <h1 class="text-center">No Item in Cart 🛒</h1>
                                    <a href="shop.php" class="btn btn-primary">Continue Shopping</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
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


<!-- Mirrored from spreethemesprevious.github.io/bisum/htmlcart.php.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 May 2024 11:37:56 GMT -->

</html>