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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- existing css -->
    <link rel="stylesheet" href="assets/css/vendor.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- enhanced styles -->
    <style>
        :root {
            --primary-color: #2e7d32;
            --secondary-color: #4caf50;
            --accent-color: #66bb6a;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --text-light: #9ca3af;
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-gradient: linear-gradient(135deg, #f5f9f5 0%, #e8f5e8 100%);
            --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --border-radius: 16px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            background: var(--bg-gradient);
            font-family: 'Poppins', sans-serif !important;
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* Modern Breadcrumb */
        .breadcrumb {
            background: var(--bg-primary);
            border-radius: 0 0 var(--border-radius) var(--border-radius);
            box-shadow: var(--shadow-sm);
            margin-bottom: 2rem;
            padding: 1.5rem 0;
        }

        .breadcrumb ul {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .breadcrumb a {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .breadcrumb a:hover {
            color: var(--primary-color);
        }

        .breadcrumb svg {
            opacity: 0.4;
        }

        .breadcrumb li:last-child {
            color: var(--primary-color);
            font-weight: 600;
        }

        /* Enhanced Wishlist Container */
        .wishlist-page {
            margin-top: 0;
        }

        .container {
            max-width: 1200px;
        }

        /* Modern Header Section */
        .wishlist-header {
            background: var(--bg-primary);
            border-radius: var(--border-radius);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-md);
            display: flex;
            justify-content: between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .wishlist-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color), var(--accent-color));
        }

        .wishlist-title {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex: 1;
        }

        .wishlist-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            box-shadow: var(--shadow-md);
        }

        .section-heading {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .wishlist-stats {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .stat-item {
            text-align: center;
            padding: 1rem 1.5rem;
            background: rgba(46, 125, 50, 0.1);
            border-radius: 12px;
            border: 2px solid transparent;
            transition: var(--transition);
        }

        .stat-item:hover {
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .stat-number {
            display: block;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 0.25rem;
        }

        /* Enhanced Clear Button */
        .clear-wishlist-form {
            display: flex;
            align-items: center;
        }

        .btn-clear {
            background: linear-gradient(135deg, var(--danger-color), #dc2626);
            color: white;
            border: none;
            padding: 0.875rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-clear:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
        }

        .btn-clear:active {
            transform: translateY(0);
        }

        /* Enhanced Product Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .product-card {
            background: var(--bg-primary);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            position: relative;
            border: 1px solid rgba(46, 125, 50, 0.1);
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-color);
        }

        .product-card-img {
            position: relative;
            overflow: hidden;
            aspect-ratio: 16/12;
        }

        .primary-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .product-card:hover .primary-img {
            transform: scale(1.05);
        }

        .product-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            z-index: 10;
        }

        .badge-label {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
            display: block;
        }

        .badge-new {
            background: linear-gradient(135deg, var(--warning-color), #d97706);
            color: white;
        }

        .badge-percentage {
            background: linear-gradient(135deg, var(--danger-color), #dc2626);
            color: white;
        }

        /* Enhanced Product Actions */
        .product-card-action {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0;
            transition: var(--transition);
            z-index: 20;
        }

        .product-card:hover .product-card-action {
            opacity: 1;
        }

        .action-card {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
            box-shadow: var(--shadow-md);
        }

        .action-card:hover {
            background: var(--primary-color);
            color: white;
            transform: scale(1.1);
        }

        /* Enhanced Product Details */
        .product-card-details {
            padding: 1.5rem;
        }

        .product-card-title {
            margin-bottom: 1rem;
        }

        .product-card-title a {
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            line-height: 1.4;
            transition: var(--transition);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-card-title a:hover {
            color: var(--primary-color);
        }

        .product-card-price {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .card-price-regular {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .card-price-compare {
            font-size: 1rem;
            color: var(--text-light);
        }

        /* Enhanced Empty State */
        .empty-wishlist {
            background: var(--bg-primary);
            border-radius: var(--border-radius);
            padding: 4rem 2rem;
            text-align: center;
            box-shadow: var(--shadow-md);
            margin-top: 2rem;
        }

        .empty-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 3rem;
            color: var(--text-light);
        }

        .empty-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .empty-subtitle {
            font-size: 1.125rem;
            color: var(--text-secondary);
            margin-bottom: 2rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            font-size: 1rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(46, 125, 50, 0.3);
            color: white;
            text-decoration: none;
        }

        /* Wishlist Remove Button */
        .wishlist-remove {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 35px;
            height: 35px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            opacity: 0;
            transform: scale(0.8);
            z-index: 15;
        }

        .product-card:hover .wishlist-remove {
            opacity: 1;
            transform: scale(1);
        }

        .wishlist-remove:hover {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .wishlist-header {
                flex-direction: column;
                text-align: center;
            }

            .section-heading {
                font-size: 2rem;
            }

            .wishlist-stats {
                justify-content: center;
                flex-wrap: wrap;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1.5rem;
            }

            .product-card-details {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .wishlist-header {
                padding: 1.5rem;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }

            .wishlist-stats {
                gap: 1rem;
            }

            .stat-item {
                padding: 0.75rem 1rem;
            }
        }

        /* Loading Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-card {
            animation: fadeInUp 0.6s ease forwards;
        }

        /* Staggered Animation */
        .product-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .product-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .product-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .product-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .product-card:nth-child(5) {
            animation-delay: 0.5s;
        }

        .product-card:nth-child(6) {
            animation-delay: 0.6s;
        }
    </style>
</head>

<body>
    <div class="body-wrapper">
        <!-- include header.php -->
        <?php include("components/header.php"); ?>
        <!-- include header.php end -->

        <!-- Enhanced breadcrumb -->
        <div class="breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="./"><i class="fas fa-home"></i> Home</a></li>
                    <li>
                        <svg class="icon icon-breadcrumb" width="16" height="16" viewBox="0 0 64 64" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.4">
                                <path
                                    d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z"
                                    fill="currentColor" />
                            </g>
                        </svg>
                    </li>
                    <li><i class="fas fa-heart"></i> Wishlist</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <main id="MainContent" class="content-for-layout">
            <div class="wishlist-page">
                <div class="wishlist-page-inner">
                    <div class="container">
                        <!-- Enhanced Header -->
                        <div class="wishlist-header">
                            <div class="wishlist-title">
                                <div class="wishlist-icon">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <h2 class="section-heading">My Wishlist</h2>
                            </div>

                            <?php
                            // Count wishlist items
                            $countWish = mysqli_query($conn, "SELECT COUNT(*) as total FROM `wish` WHERE `userid` = '$userid'");
                            $wishCount = mysqli_fetch_assoc($countWish)['total'];

                            // Calculate total value
                            $totalValue = 0;
                            $valueQuery = mysqli_query($conn, "SELECT p.price, p.discount FROM `wish` w JOIN `products` p ON w.productid = p.productid WHERE w.userid = '$userid'");
                            while ($item = mysqli_fetch_assoc($valueQuery)) {
                                $price = $item['discount'] > 0 ? $item['price'] - ($item['price'] * ($item['discount'] / 100)) : $item['price'];
                                $totalValue += $price;
                            }
                            ?>

                            <div class="wishlist-stats">
                                <div class="stat-item">
                                    <span class="stat-number"><?= $wishCount ?></span>
                                    <div class="stat-label">Items</div>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number">₦<?= number_format($totalValue) ?></span>
                                    <div class="stat-label">Total Value</div>
                                </div>
                            </div>

                            <form method="post" class="clear-wishlist-form">
                                <button type="submit" name="clear" class="btn-clear">
                                    <i class="fas fa-trash-alt"></i>
                                    Clear All
                                </button>
                                <?php
                                if (isset($_POST["clear"])) {
                                    $clearWish = mysqli_query($conn, "DELETE FROM `wish` WHERE `userid` = '$userid'");
                                    if ($clearWish) {
                                        echo "<script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                alert('Wishlist cleared successfully! 🗑️');
                                                setTimeout(() => location.reload(), 1000);
                                            });
                                        </script>";
                                    }
                                }
                                ?>
                            </form>
                        </div>

                        <!-- Products Grid -->
                        <div class="products-grid">
                            <?php
                            $getWish = mysqli_query($conn, "SELECT * FROM `wish` WHERE `userid` = '$userid'");
                            if (mysqli_num_rows($getWish) > 0):
                                while ($fetchedWishes = mysqli_fetch_assoc($getWish)):
                                    $productid = $fetchedWishes["productid"];
                                    $getProduct = mysqli_query($conn, "SELECT * FROM `products` WHERE `productid` = '$productid'");

                                    if (mysqli_num_rows($getProduct) > 0):
                                        $products = mysqli_fetch_assoc($getProduct);
                                        $discount = 0;
                                        if ($products["discount"] > 0) {
                                            $discount = $products["price"] - ($products["price"] * ($products["discount"] / 100));
                                        }
                                        ?>
                                        <div class="product-card">
                                            <div class="product-card-img">
                                                <a class="hover-switch" href="product.php?pid=<?= $products["productid"]; ?>">
                                                    <img class="primary-img" src="uploads/<?= $products["image"]; ?>"
                                                        alt="<?= htmlspecialchars($products["name"]); ?>" />
                                                </a>

                                                <div class="product-badge">
                                                    <?php if ($products["discount"] > 0): ?>
                                                        <span
                                                            class="badge-label badge-percentage">-<?= $products["discount"]; ?>%</span>
                                                    <?php endif; ?>
                                                </div>

                                                <!-- <button class="wishlist-remove" onclick="removeFromWishlist(<?= $products['productid']; ?>)">
                                                                <i class="fas fa-times"></i>
                                                            </button> -->

                                                <div class="product-card-action product-card-action-2">
                                                    <a href="addtocart.php?pid=<?= $products["productid"]; ?>"
                                                        class="action-card action-addtocart">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="product-card-details">
                                                <h3 class="product-card-title">
                                                    <a
                                                        href="product.php?pid=<?= $products["productid"]; ?>"><?= htmlspecialchars($products["name"]); ?></a>
                                                </h3>

                                                <?php if ($products["discount"] > 0): ?>
                                                    <div class="product-card-price">
                                                        <span class="card-price-regular">₦<?= number_format($discount); ?></span>
                                                        <span
                                                            class="card-price-compare">₦<?= number_format($products["price"]); ?></span>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="product-card-price">
                                                        <span
                                                            class="card-price-regular">₦<?= number_format($products["price"]); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php
                                    endif;
                                endwhile;
                            else:
                                ?>
                                <div class="empty-wishlist" style="grid-column: 1 / -1;">
                                    <div class="empty-icon">
                                        <i class="fas fa-heart-broken"></i>
                                    </div>
                                    <h2 class="empty-title">Your Wishlist is Empty</h2>
                                    <p class="empty-subtitle">Discover amazing herbal products and add them to your
                                        wishlist!</p>
                                    <a href="shop.php" class="btn-primary">
                                        <i class="fas fa-shopping-bag"></i>
                                        Start Shopping
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- include footer -->
        <?php include("components/footer.php"); ?>
        <!-- include footer end -->

        <!-- all js -->
        <script src="assets/js/vendor.js"></script>
        <script src="assets/js/main.js"></script>

        <script>
            // Remove from wishlist function
            function removeFromWishlist(productId) {
                if (confirm('Are you sure you want to remove this item from your wishlist?')) {
                    fetch('remove_from_wishlist.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `productid=${productId}`
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            } else {
                                alert('Error removing item from wishlist');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error removing item from wishlist');
                        });
                }
            }

            // Add smooth scrolling
            document.addEventListener('DOMContentLoaded', function () {
                const links = document.querySelectorAll('a[href^="#"]');
                links.forEach(link => {
                    link.addEventListener('click', function (e) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth'
                            });
                        }
                    });
                });
            });
        </script>
    </div>
</body>

</html>