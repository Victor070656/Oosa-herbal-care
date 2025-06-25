<?php
include_once("functions.php");
session_start();

if (!isset($_SESSION["user"])) {
    echo "<script>location.href='login.php'</script>";
} else {
    $userid = $_SESSION["user"]["userid"];
}

$getOrders = mysqli_query($conn, "SELECT * FROM `orders` WHERE `userid` = '$userid' ORDER BY `id` DESC");
$orders = mysqli_fetch_all($getOrders, true);
//dd($orders);
?>
<!doctype html>
<html lang="en" class="no-js">


<!-- Mirrored from spreethemesprevious.github.io/bisum/html/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 May 2024 11:37:56 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <title>Oosa Herbal Care || Orders</title>
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
                    <li>Orders</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <main id="MainContent" class="content-for-layout">
            <div class="cart-page mt-100">
                <div class="container">
                    <div class="section-header mb-3">
                        <h2 class="section-heading">My Orders</h2>
                    </div>
                    <div class="card py-3 px-3">
                        <div class="card-body">
                            <?php
                            foreach ($orders as $order) {
                                $items = json_decode($order["items"], true);

                                ?>
                                <div
                                    class="d-flex justify-content-between align-items-center py-2 border-bottom table-responsive">

                                    <div class="info">
                                        <h5><a href="view-order.php?oid=<?= $order['orderid']; ?>"
                                                class="text-secondary">#<?= $order["orderid"]; ?></a></h5>
                                        <small
                                            class="mb-3 text-secondary"><?= date("d M, Y H:i", strtotime($order["created_at"])); ?></small>
                                        <div class="text-truncate">
                                            <p class="">
                                                <?php
                                                for ($i = 0; $i < count($items); $i++) {
                                                    $productid = $items[$i]["productid"];
                                                    $getProduct = mysqli_query($conn, "SELECT * FROM `products` WHERE `productid` = '$productid'");
                                                    $product = mysqli_fetch_assoc($getProduct);
                                                    if ($items[$i] == $items[count($items) - 1]) {
                                                        echo $items[$i]["quantity"] . " " . $product["name"];
                                                    } else {
                                                        echo $items[$i]["quantity"] . " " . $product["name"] . ", ";
                                                    }

                                                }
                                                //
                                                ?>
                                            </p>
                                        </div>

                                        <small class="text-warning"><?= $order["status"]; ?></small>
                                    </div>
                                    <div class="action px-3">
                                        <h5><a href="view-order.php?oid=<?= $order['orderid']; ?>" class="text-dark">⟫</a>
                                        </h5>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
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


<!-- Mirrored from spreethemesprevious.github.io/bisum/html/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 May 2024 11:37:56 GMT -->

</html>