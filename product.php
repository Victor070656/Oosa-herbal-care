<?php
include_once("functions.php");
session_start();

if (isset($_GET["pid"])) {
    $productid = $_GET["pid"];
} else {
    echo "<script>location.href='/'</script>";
}

if (isset($_SESSION["user"])) {
    $userid = $_SESSION["user"]["userid"];
}

$discount = 0;
$amount = 0;
$shipping = 0;
$payment_amount = 0;
$getProduct = mysqli_query($conn, "SELECT * FROM `products` WHERE `productid` = '$productid'");
$product = mysqli_fetch_array($getProduct);

$discount = $product["price"] - ($product["price"] * ($product["discount"] / 100));

if ($product["discount"] == 0) {
    $amount = $product["price"];
} else {
    $amount = $discount;
}

if ((float) $product["price"] <= 1000) {
    $shipping = (float) $product["price"] * 0.1;
} elseif ((float) $product["price"] <= 5000) {
    $shipping = (float) $product["price"] * 0.15;
} else {
    $shipping = (float) $product["price"] * 0.25;
}
$paymentamount = (float) $product["price"] + $shipping;
//dd($paymentamount);
?>
<!doctype html>
<html lang="en" class="no-js">


<!-- Mirrored from spreethemesprevious.github.io/bisum/html/product.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 May 2024 11:37:45 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <title>Oosa Herbal Ventures | Product Detail</title>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Oosa Herbal Ventures">
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
                    <li>Product</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <main id="MainContent" class="content-for-layout">
            <div class="product-page mt-100">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-12">
                            <div class="product-gallery product-gallery-vertical d-flex">
                                <img src="uploads/<?= $product["image"]; ?>" alt="" class="img-fluid w-100"
                                    style="border-radius: 15px;">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-12" style="align-self: center;">
                            <div class="product-details ps-lg-4 ">
                                <!-- <div class="mb-3"><span class="product-availability">In Stock</span></div> -->
                                <h2 class="product-title mb-3 mt-3"><?= $product["name"]; ?></h2>
                                <div class="product-rating d-flex align-items-center mb-3">
                                    <span class="star-rating">
                                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.168 5.77344L10.082 5.23633L8 0.566406L5.91797 5.23633L0.832031 5.77344L4.63086 9.19727L3.57031 14.1992L8 11.6445L12.4297 14.1992L11.3691 9.19727L15.168 5.77344Z"
                                                fill="#FFAE00" />
                                        </svg>
                                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.168 5.77344L10.082 5.23633L8 0.566406L5.91797 5.23633L0.832031 5.77344L4.63086 9.19727L3.57031 14.1992L8 11.6445L12.4297 14.1992L11.3691 9.19727L15.168 5.77344Z"
                                                fill="#FFAE00" />
                                        </svg>
                                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.168 5.77344L10.082 5.23633L8 0.566406L5.91797 5.23633L0.832031 5.77344L4.63086 9.19727L3.57031 14.1992L8 11.6445L12.4297 14.1992L11.3691 9.19727L15.168 5.77344Z"
                                                fill="#FFAE00" />
                                        </svg>
                                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.168 5.77344L10.082 5.23633L8 0.566406L5.91797 5.23633L0.832031 5.77344L4.63086 9.19727L3.57031 14.1992L8 11.6445L12.4297 14.1992L11.3691 9.19727L15.168 5.77344Z"
                                                fill="#FFAE00" />
                                        </svg>
                                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.168 5.77344L10.082 5.23633L8 0.566406L5.91797 5.23633L0.832031 5.77344L4.63086 9.19727L3.57031 14.1992L8 11.6445L12.4297 14.1992L11.3691 9.19727L15.168 5.77344Z"
                                                fill="#B2B2B2" />
                                        </svg>
                                    </span>
                                    <span class="rating-count ms-2">(22)</span>
                                </div>
                                <div class="product-price-wrapper mb-4">
                                    <span class="product-price regular-price">₦<?= number_format($discount); ?></span>
                                    <?php if ($product["discount"] > 0): ?>
                                        <del
                                            class="product-price compare-price ms-2">₦<?= number_format($product["price"]); ?></del>
                                    <?php endif; ?>
                                </div>

                                <form method="post" class="product-form">
                                    <div class=" misc d-flex align-items-end justify-content-between mt-4">
                                        <div class="quantity d-flex align-items-center justify-content-between">
                                            <span class="qty-btn dec-qty"><img src="assets/img/icon/minus.svg"
                                                    alt="minus"></span>
                                            <input class="qty-input" type="number" name="qty" value="1" min="0">
                                            <span class="qty-btn inc-qty"><img src="assets/img/icon/plus.svg"
                                                    alt="plus"></span>
                                        </div>
                                    </div>


                                    <div
                                        class="product-form-buttons d-flex align-items-center justify-content-between mt-4">
                                        <button type="submit" name="addtocart"
                                            class="position-relative btn-atc btn-add-to-cart loader">ADD TO
                                            CART</button>
                                        <a href="addtowish.php?pid=<?= $productid; ?>" class="product-wishlist">
                                            <svg class="icon icon-wishlist" width="26" height="22" viewBox="0 0 26 22"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                                    fill="#2e7d32"></path>
                                            </svg>
                                        </a>
                                    </div>
                                    <?php
                                    if (isset($_POST["addtocart"])) {
                                        // var_dump($_POST);
                                        if (!isset($_SESSION["user"])) {
                                            echo "<script>location.href='login.php';alert('You are not logged in!')</script>";
                                        } else {
                                            $qty = (int) $_POST["qty"];

                                            $checkCart = mysqli_query($conn, "SELECT * FROM `cart` WHERE `userid` = '$userid' AND `productid` = '$productid'");
                                            if (mysqli_num_rows($checkCart) > 0) {
                                                $addToCart = mysqli_query($conn, "UPDATE `cart` SET `quantity`=(`quantity` + $qty) WHERE `userid` = '$userid' AND `productid` = '$productid'");
                                                echo "<script>location.href='cart.php';alert('One additional product added to your cart 🛒')</script>";
                                            } else {
                                                $addToCart = mysqli_query($conn, "INSERT INTO `cart` (`userid`, `productid`, `quantity`) VALUES ('$userid', '$productid', $qty)");
                                                if ($addToCart) {
                                                    echo "<script>location.href='cart.php';alert('Product added to your cart 🛒')</script>";
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </form>
                                <form method="post" action="checkout.php">
                                    <?php
                                    $items = [
                                        [
                                            "userid" => $userid ?? null,
                                            "productid" => $productid,
                                            "quantity" => "1"
                                        ]
                                    ];
                                    $a = json_encode($items);


                                    ?>
                                    <textarea name="items" hidden="hidden"><?= $a; ?></textarea>
                                    <input type="hidden" name="amount" value="<?= $paymentamount; ?>">
                                    <div class="buy-it-now-btn mt-2">
                                        <button type="submit" class="position-relative btn-atc btn-buyit-now">BUY IT
                                            NOW</button>
                                    </div>

                                </form>

                                <div class="guaranteed-checkout">
                                    <strong class="label mb-1 d-block">Guaranteed safe checkout:</strong>
                                    <ul class="list-unstyled checkout-icon-list d-flex align-items-center flex-wrap">
                                        <li class="checkout-icon-item">
                                            <svg width="38" height="24" viewBox="0 0 38 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_205_2246)">
                                                    <path opacity="0.07"
                                                        d="M35 0H3C1.3 0 0 1.3 0 3V21C0 22.7 1.4 24 3 24H35C36.7 24 38 22.7 38 21V3C38 1.3 36.6 0 35 0Z"
                                                        fill="black" />
                                                    <path
                                                        d="M35 1C36.1 1 37 1.9 37 3V21C37 22.1 36.1 23 35 23H3C1.9 23 1 22.1 1 21V3C1 1.9 1.9 1 3 1H35Z"
                                                        fill="#FEFEFE" />
                                                    <path
                                                        d="M15 19C18.866 19 22 15.866 22 12C22 8.13401 18.866 5 15 5C11.134 5 8 8.13401 8 12C8 15.866 11.134 19 15 19Z"
                                                        fill="#EB001B" />
                                                    <path
                                                        d="M23 19C26.866 19 30 15.866 30 12C30 8.13401 26.866 5 23 5C19.134 5 16 8.13401 16 12C16 15.866 19.134 19 23 19Z"
                                                        fill="#F79E1B" />
                                                    <path
                                                        d="M22 12C22 9.59999 20.8 7.49999 19 6.29999C17.2 7.59999 16 9.69999 16 12C16 14.3 17.2 16.5 19 17.7C20.8 16.5 22 14.4 22 12Z"
                                                        fill="#FF5F00" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_205_2246">
                                                        <rect width="38" height="24" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </li>
                                        <li class="checkout-icon-item">
                                            <svg width="38" height="24" viewBox="0 0 38 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_205_2274)">
                                                    <path opacity="0.07"
                                                        d="M35 0H3C1.3 0 0 1.3 0 3V21C0 22.7 1.4 24 3 24H35C36.7 24 38 22.7 38 21V3C38 1.3 36.6 0 35 0Z"
                                                        fill="black" />
                                                    <path
                                                        d="M35 1C36.1 1 37 1.9 37 3V21C37 22.1 36.1 23 35 23H3C1.9 23 1 22.1 1 21V3C1 1.9 1.9 1 3 1H35Z"
                                                        fill="#FEFEFE" />
                                                    <path
                                                        d="M28.3 10.1H28C27.6 11.1 27.3 11.6 27 13.1H28.9C28.6 11.6 28.6 10.9 28.3 10.1ZM31.2 16H29.5C29.4 16 29.4 16 29.3 15.9L29.1 15L29 14.8H26.6C26.5 14.8 26.4 14.8 26.4 15L26.1 15.9C26.1 16 26 16 26 16H23.9L24.1 15.5L27 8.7C27 8.2 27.3 8 27.8 8H29.3C29.4 8 29.5 8 29.5 8.2L30.9 14.7C31 15.1 31.1 15.4 31.1 15.8C31.2 15.9 31.2 15.9 31.2 16ZM17.8 15.7L18.2 13.9C18.3 13.9 18.4 14 18.4 14C19.1 14.3 19.8 14.5 20.5 14.4C20.7 14.4 21 14.3 21.2 14.2C21.7 14 21.7 13.5 21.3 13.1C21.1 12.9 20.8 12.8 20.5 12.6C20.1 12.4 19.7 12.2 19.4 11.9C18.2 10.9 18.6 9.5 19.3 8.8C19.9 8.4 20.2 8 21 8C22.2 8 23.5 8 24.1 8.2H24.2C24.1 8.8 24 9.3 23.8 9.9C23.3 9.7 22.8 9.5 22.3 9.5C22 9.5 21.7 9.5 21.4 9.6C21.2 9.6 21.1 9.7 21 9.8C20.8 10 20.8 10.3 21 10.5L21.5 10.9C21.9 11.1 22.3 11.3 22.6 11.5C23.1 11.8 23.6 12.3 23.7 12.9C23.9 13.8 23.6 14.6 22.8 15.2C22.3 15.6 22.1 15.8 21.4 15.8C20 15.8 18.9 15.9 18 15.6C17.9 15.8 17.9 15.8 17.8 15.7ZM14.3 16C14.4 15.3 14.4 15.3 14.5 15C15 12.8 15.5 10.5 15.9 8.3C16 8.1 16 8 16.2 8H18C17.8 9.2 17.6 10.1 17.3 11.2C17 12.7 16.7 14.2 16.3 15.7C16.3 15.9 16.2 15.9 16 15.9L14.3 16ZM5 8.2C5 8.1 5.2 8 5.3 8H8.7C9.2 8 9.6 8.3 9.7 8.8L10.6 13.2C10.6 13.3 10.6 13.3 10.7 13.4C10.7 13.3 10.8 13.3 10.8 13.3L12.9 8.2C12.8 8.1 12.9 8 13 8H15.1C15.1 8.1 15.1 8.1 15 8.2L11.9 15.5C11.8 15.7 11.8 15.8 11.7 15.9C11.6 16 11.4 15.9 11.2 15.9H9.7C9.6 15.9 9.5 15.9 9.5 15.7L7.9 9.5C7.7 9.3 7.4 9 7 8.9C6.4 8.6 5.3 8.4 5.1 8.4L5 8.2Z"
                                                        fill="#FFD200" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_205_2274">
                                                        <rect width="38" height="24" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- product tab start -->
            <div class="product-tab-section mt-100" data-aos="fade-up" data-aos-duration="700">
                <div class="container">
                    <div class="tab-list product-tab-list">
                        <nav class="nav product-tab-nav">
                            <a class="product-tab-link tab-link active" href="#pdescription"
                                data-bs-toggle="tab">Description</a>
                            <!-- <a class="product-tab-link tab-link" href="#pshipping" data-bs-toggle="tab">Shipping & Returns</a> -->
                            <!-- <a class="product-tab-link tab-link" href="#preview" data-bs-toggle="tab">Reviews</a> -->
                        </nav>
                    </div>
                    <div class="tab-content product-tab-content">
                        <div id="pdescription" class="tab-pane fade show active">
                            <div class="row">
                                <div class=" col-12">
                                    <div class="desc-content">
                                        <h4 class="mb-3">Product Description</h4>
                                        <p class="text_16 mb-4"><?= $product["description"]; ?></p>
                                    </div>
                                    <div class="desc-content">
                                        <h4 class="mb-3">Product Details</h4>
                                        <p class="text_16 mb-4"><?= $product["details"]; ?></p>
                                    </div>
                                </div>
                            </div>
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


<!-- Mirrored from spreethemesprevious.github.io/bisum/html/product.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 May 2024 11:37:45 GMT -->

</html>