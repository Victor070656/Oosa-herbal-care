<?php
include_once("functions.php");
session_start();

if (!isset($_SESSION["user"])) {
    echo "<script>location.href='login.php'</script>";
} else {
    $userid = $_SESSION["user"]["userid"];
}
?>
<!doctype html>
<html lang="en" class="no-js">


<!-- Mirrored from spreethemesprevious.github.io/bisum/html/wishlist.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 May 2024 11:37:56 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <title>Oosa Herbal Care || Wishlist</title>
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
                    <li>Wishlist</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <main id="MainContent" class="content-for-layout">
            <div class="wishlist-page mt-100">
                <div class="wishlist-page-inner">
                    <div class="container">
                        <div class="section-header d-flex align-items-center justify-content-between flex-wrap">
                            <h2 class="section-heading">My Wishlist</h2>
                            <form method="post">
                                <input type="submit" name="clear" value="Clear Wishlist" class="btn btn-link fw-bold">
                                <?php
                                if (isset($_POST["clear"])) {
                                    $clearWish = mysqli_query($conn, "DELETE FROM `wish` WHERE `userid` = '$userid'");
                                    if ($clearWish) {
                                        echo "<script>alert('Wishlist cleared 🗑️')</script>";
                                    }
                                }
                                ?>
                            </form>
                        </div>
                        <hr>
                        <div class="row">
                            <?php
                            $getWish = mysqli_query($conn, "SELECT * FROM `wish` WHERE `userid` = '$userid'");
                            if (mysqli_num_rows($getWish) > 0):
                                $fetchedWishes = mysqli_fetch_assoc($getWish);
                                $productid = $fetchedWishes["productid"];
                                $getPopularProducts = mysqli_query($conn, "SELECT * FROM `products` WHERE `productid` = '$productid' ORDER BY `id` DESC");


                                if (mysqli_num_rows($getPopularProducts) > 0):
                                    while ($products = mysqli_fetch_assoc($getPopularProducts)):
                                        $discount;
                                        if ($products["discount"] > 0) {
                                            $discount = $products["price"] - ($products["price"] * ($products["discount"] / 100));
                                        }


                                        ?>
                                        <div class="col-lg-3 col-md-6 col-6" data-aos="fade-up" data-aos-duration="700">
                                            <div class="product-card shadow-sm">
                                                <div class="product-card-img">
                                                    <a class="hover-switch" href="product.php?pid=<?= $products["productid"]; ?>">
                                                        <img class="primary-img" src="uploads/<?= $products["image"]; ?>"
                                                            style="aspect-ratio: 16/9; width: 100%; object-fit: cover; background-color: #fff; "
                                                            alt="product-img" />
                                                    </a>

                                                    <div class="product-badge">
                                                        <!-- <span class="badge-label badge-new rounded">Featured</span>
                                                  <span class="badge-label badge-percentage rounded">-44%</span> -->
                                                    </div>

                                                    <div class="product-card-action product-card-action-2 justify-content-center">


                                                        <a href="addtocart.php?pid=<?= $products["productid"]; ?>"
                                                            class="action-card action-addtocart">
                                                            <svg class="icon icon-cart" width="24" height="26" viewBox="0 0 24 26"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M12 0.000183105C9.25391 0.000183105 7 2.25409 7 5.00018V6.00018H2.0625L2 6.93768L1 24.9377L0.9375 26.0002H23.0625L23 24.9377L22 6.93768L21.9375 6.00018H17V5.00018C17 2.25409 14.7461 0.000183105 12 0.000183105ZM12 2.00018C13.6562 2.00018 15 3.34393 15 5.00018V6.00018H9V5.00018C9 3.34393 10.3438 2.00018 12 2.00018ZM3.9375 8.00018H7V11.0002H9V8.00018H15V11.0002H17V8.00018H20.0625L20.9375 24.0002H3.0625L3.9375 8.00018Z"
                                                                    fill="#2e7d32" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-card-details px-2 pb-2">

                                                    <h3 class="product-card-title text-truncate">
                                                        <a class=""
                                                            href="product.php?pid=<?= $products["productid"]; ?>"><?= $products["name"]; ?></a>
                                                    </h3>
                                                    <?php if ($products["discount"] > 0): ?>
                                                        <div class="product-card-price">
                                                            <span class="card-price-regular">₦<?= $discount; ?></span>
                                                            <span
                                                                class="card-price-compare text-decoration-line-through">₦<?= $products["price"]; ?></span>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="product-card-price">
                                                            <span class="card-price-regular">₦<?= $products["price"]; ?></span>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    endwhile;
                                endif;
                            else:
                                ?>
                                <div class="card" style="border-radius: 15px">
                                    <div class="card-body d-flex justify-content-center" style="min-height: 200px; ">
                                        <div class="my-auto text-center">
                                            <h1 class="text-center">No Item in your Wishlist 🖤</h1>
                                            <a href="shop.php" class="btn btn-primary">Continue Shopping</a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endif;

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


<!-- Mirrored from spreethemesprevious.github.io/bisum/html/wishlist.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 May 2024 11:37:56 GMT -->

</html>