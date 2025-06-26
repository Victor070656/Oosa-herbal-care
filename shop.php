<?php
include_once("functions.php");
session_start();
require "vendor/autoload.php";

$getProducts = mysqli_query($conn, "SELECT * FROM `products` ORDER BY `id` DESC");
//dd($getProducts);
if (isset($_GET["s"])) {
    $s = htmlspecialchars($_GET["s"]);
    $getPopularProducts = mysqli_query($conn, "SELECT p.*, c.category_name FROM `products` as p JOIN `categories` as c ON p.category_id = c.id WHERE (p.name LIKE '%$s%') OR (p.tags LIKE '%$s%') OR (p.description LIKE '%$s%') OR (c.category_name LIKE '%$s%') ORDER BY p.id DESC");
} else {
    $getPopularProducts = mysqli_query($conn, "SELECT p.*, c.category_name FROM `products` as p JOIN `categories` as c ON p.category_id = c.id ORDER BY p.id DESC");
}

$records_per_page = 12;
?>

<!doctype html>
<html lang="en" class="no-js">


<!-- Mirrored from spreethemesprevious.github.io/bisum/html/collection-without-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 May 2024 11:37:45 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <title>Oosa Herbal Care || Shop</title>
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

        .product-card {
            transition: all 0.3s ease;
            border-radius: 12px !important;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .product-image {
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .product-actions {
            transition: opacity 0.3s ease;
        }

        .product-card:hover .product-actions {
            opacity: 1 !important;
        }

        .transition-transform {
            transition: transform 0.3s ease;
        }

        .transition-opacity {
            transition: opacity 0.3s ease;
        }

        .stretched-link::after {
            z-index: 1;
        }

        .product-actions .btn {
            position: relative;
            z-index: 2;
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.9) !important;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
        }

        .product-actions .btn-dark {
            background-color: rgba(0, 0, 0, 0.8) !important;
            color: white !important;
        }

        .product-actions .btn:hover {
            transform: scale(1.1);
        }

        /* Mobile responsiveness */
        @media (max-width: 576px) {
            .product-actions {
                opacity: 1 !important;
                position: static !important;
                transform: none !important;
                margin-top: 1rem;
            }

            .product-card:hover {
                transform: none;
            }
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
                    <li>Products</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <main id="MainContent" class="content-for-layout">
            <div class="collection mt-100">
                <div class="container">
                    <div class="row">
                        <!-- product area start -->
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="filter-sort-wrapper d-flex justify-content-between flex-wrap">
                                <div class="collection-title-wrap d-flex align-items-end">
                                    <h2 class="collection-title heading_24 mb-0">All products</h2>
                                    <p class="collection-counter text_16 mb-0 ms-2">
                                        (<?= $getPopularProducts->num_rows; ?>
                                        items)
                                    </p>
                                </div>

                            </div>
                            <div class="collection-product-container">
                                <div class="row">
                                    <?php
                                    // if (isset($_GET["s"])) {
                                    //     $getPopularProducts = mysqli_query($conn, "SELECT p.*, c.category_name FROM `products` as p JOIN `categories` as c ON p.category_id = c.id WHERE (p.name LIKE '%$s%') OR (p.tags LIKE '%$s%') OR (p.description LIKE '%$s%') OR (c.category_name LIKE '%$s%') ORDER BY p.id DESC");
                                    // } else {
                                    //     $getPopularProducts = mysqli_query($conn, "SELECT p.*, c.category_name FROM `products` as p JOIN `categories` as c ON p.category_id = c.id ORDER BY p.id DESC");
                                    // }
                                    
                                    if (mysqli_num_rows($getPopularProducts) > 0):
                                        $items = mysqli_fetch_all($getPopularProducts, MYSQLI_ASSOC);
                                        $pagination = new Zebra_Pagination();

                                        $pagination->records(count($items));

                                        // records per page
                                        $pagination->records_per_page($records_per_page);

                                        $items = array_slice($items, ($pagination->get_page() - 1) * $records_per_page, $records_per_page);

                                        foreach ($items as $products):
                                            $discount;
                                            if ($products["discount"] > 0) {
                                                $discount = $products["price"] - ($products["price"] * ($products["discount"] / 100));
                                            }


                                            ?>
                                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6" data-aos="fade-up"
                                                data-aos-duration="700">
                                                <div
                                                    class="card h-100 shadow-sm border-0 product-card position-relative overflow-hidden">

                                                    <!-- Discount Badge -->
                                                    <?php if ($products["discount"] > 0): ?>
                                                        <div class="position-absolute m-2" style="z-index: 10;top: 0; left: 0;">
                                                            <small class="badge bg-danger rounded-pill fw-semibold">
                                                                -<?= $products["discount"]; ?>%
                                                            </small>
                                                        </div>
                                                    <?php endif; ?>

                                                    <!-- Product Image Container -->
                                                    <div class="position-relative overflow-hidden bg-light">
                                                        <a href="product.php?pid=<?= $products["productid"]; ?>"
                                                            class="text-decoration-none d-block">
                                                            <img src="uploads/<?= $products["image"]; ?>"
                                                                class="card-img-top product-image transition-transform"
                                                                alt="<?= htmlspecialchars($products["name"]); ?>"
                                                                style="aspect-ratio: 4/3; object-fit: cover; height: 250px;"
                                                                loading="lazy" />
                                                        </a>

                                                        <!-- Hover Action Buttons -->
                                                        <div class="product-actions position-absolute top-50 start-50 translate-middle opacity-0 transition-opacity"
                                                            style="z-index: 20;">
                                                            <div class="d-flex gap-2">
                                                                <a href="addtowish.php?pid=<?= $products["productid"]; ?>"
                                                                    class="btn btn-outline-dark btn-sm rounded-pill d-flex align-items-center justify-content-center"
                                                                    style="width: 40px; height: 40px;" title="Add to Wishlist"
                                                                    aria-label="Add <?= htmlspecialchars($products["name"]); ?> to wishlist">
                                                                    <svg width="18" height="16" viewBox="0 0 26 22" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                                                            fill="currentColor" />
                                                                    </svg>
                                                                </a>

                                                                <a href="addtocart.php?pid=<?= $products["productid"]; ?>"
                                                                    class="btn btn-dark btn-sm rounded-pill d-flex align-items-center justify-content-center"
                                                                    style="width: 40px; height: 40px;" title="Add to Cart"
                                                                    aria-label="Add <?= htmlspecialchars($products["name"]); ?> to cart">
                                                                    <svg width="18" height="20" viewBox="0 0 24 26" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M12 0.000183105C9.25391 0.000183105 7 2.25409 7 5.00018V6.00018H2.0625L2 6.93768L1 24.9377L0.9375 26.0002H23.0625L23 24.9377L22 6.93768L21.9375 6.00018H17V5.00018C17 2.25409 14.7461 0.000183105 12 0.000183105ZM12 2.00018C13.6562 2.00018 15 3.34393 15 5.00018V6.00018H9V5.00018C9 3.34393 10.3438 2.00018 12 2.00018ZM3.9375 8.00018H7V11.0002H9V8.00018H15V11.0002H17V8.00018H20.0625L20.9375 24.0002H3.0625L3.9375 8.00018Z"
                                                                            fill="currentColor" />
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Product Details -->
                                                    <div class="card-body d-flex flex-column">
                                                        <h5 class="card-title mb-2 lh-sm">
                                                            <a href="product.php?pid=<?= $products["productid"]; ?>"
                                                                class="text-decoration-none text-dark fw-medium stretched-link"
                                                                style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                                <?= htmlspecialchars($products["name"]); ?>
                                                            </a>
                                                        </h5>
                                                        <div class="">

                                                            <small
                                                                class="badge bg-success rounded-pill d-inline"><?= htmlspecialchars($products["category_name"]); ?></small>
                                                        </div>

                                                        <!-- Price Section -->
                                                        <div class="mt-auto">
                                                            <?php if ($products["discount"] > 0): ?>
                                                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                                                    <span class="fs-5 fw-bold text-success mb-0">
                                                                        ₦<?= number_format($discount, 0); ?>
                                                                    </span>
                                                                    <span class="text-muted text-decoration-line-through fs-6">
                                                                        ₦<?= number_format($products["price"], 0); ?>
                                                                    </span>
                                                                </div>
                                                                <small class="text-success fw-medium">
                                                                    You save
                                                                    ₦<?= number_format($products["price"] - $discount, 0); ?>
                                                                </small>
                                                            <?php else: ?>
                                                                <span class="fs-5 fw-bold text-dark mb-0">
                                                                    ₦<?= number_format($products["price"], 0); ?>
                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>

                                </div>
                            </div>
                        </div>
                        <!-- product area end -->

                        <div class="mt-5">
                            <div class="mt-3">
                                <?php $pagination->render(); ?>
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


<!-- Mirrored from spreethemesprevious.github.io/bisum/html/collection-without-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 May 2024 11:37:45 GMT -->

</html>