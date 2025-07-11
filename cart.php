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
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>Oosa Herbal Ventures | Cart</title>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Oosa Herbal Ventures">
    <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #2e7d32;
            --primary-light: #4caf50;
            --primary-dark: #1b5e20;
            --secondary-color: #f8f9fa;
            --accent-color: #ff6b35;
            --text-primary: #212529;
            --text-secondary: #6c757d;
            --text-muted: #adb5bd;
            --border-color: #e9ecef;
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 8px 32px rgba(0, 0, 0, 0.12);
            --gradient-primary: linear-gradient(135deg, #2e7d32 0%, #4caf50 100%);
            --gradient-card: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif !important;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: var(--text-primary);
            line-height: 1.6;
        }

        .container-modern {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        /* Header Styles */
        .page-header {
            background: var(--gradient-primary);
            color: white;
            padding: 3rem 0;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="white" opacity="0.1"/><circle cx="80" cy="40" r="1" fill="white" opacity="0.1"/><circle cx="40" cy="80" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.1;
        }

        .page-header .container {
            position: relative;
            z-index: 2;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .breadcrumb-modern {
            background: none;
            padding: 0;
            margin: 1rem 0 0 0;
            font-size: 0.9rem;
            opacity: 0.9;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            list-style: none;
        }

        .breadcrumb-modern li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .breadcrumb-modern li:not(:last-child)::after {
            content: '/';
            color: rgba(255, 255, 255, 0.6);
            font-weight: 300;
        }

        .breadcrumb-modern a {
            color: white;
            text-decoration: none;
            transition: opacity 0.3s ease;
        }

        .breadcrumb-modern a:hover {
            opacity: 0.8;
        }

        .breadcrumb-modern li:last-child {
            color: rgba(255, 255, 255, 0.8);
        }

        /* Cart Styles */
        .cart-container {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 3rem;
            align-items: start;
        }

        @media (max-width: 992px) {
            .cart-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }

        .cart-items {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .cart-header {
            background: var(--gradient-card);
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--border-color);
        }

        .cart-header h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .cart-item {
            padding: 2rem;
            border-bottom: 1px solid var(--border-color);
            transition: background-color 0.3s ease;
        }

        .cart-item:hover {
            background-color: #fafbfc;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-content {
            display: grid;
            grid-template-columns: 100px 1fr auto;
            gap: 1.5rem;
            align-items: center;
        }

        @media (max-width: 768px) {
            .item-content {
                grid-template-columns: 80px 1fr;
                gap: 1rem;
            }
        }

        .item-image {
            width: 100px;
            height: 100px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            position: relative;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .item-image:hover img {
            transform: scale(1.05);
        }

        .item-details h3 {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0 0 0.5rem 0;
            color: var(--text-primary);
        }

        .item-details h3 a {
            text-decoration: none;
            color: inherit;
            transition: color 0.3s ease;
        }

        .item-details h3 a:hover {
            color: var(--primary-color);
        }

        .item-tags {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--secondary-color);
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin-bottom: 1rem;
        }

        .item-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 1rem;
        }

        @media (max-width: 768px) {
            .item-actions {
                grid-column: 1 / -1;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                margin-top: 1rem;
            }
        }

        .item-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .remove-btn {
            background: none;
            border: 2px solid #dc3545;
            color: #dc3545;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .remove-btn:hover {
            background: #dc3545;
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Summary Styles */
        .cart-summary {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            position: sticky;
            top: 2rem;
        }

        .summary-header {
            background: var(--gradient-card);
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--border-color);
            border-radius: 20px 20px 0 0;
        }

        .summary-header h3 {
            margin: 0;
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .summary-content {
            padding: 2rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .summary-row:last-of-type {
            border-bottom: 2px solid var(--primary-color);
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .summary-row.total {
            border-bottom: none;
            margin-bottom: 0;
            padding-top: 1.5rem;
            font-size: 1.3rem;
            font-weight: 700;
        }

        .checkout-btn {
            width: 100%;
            background: var(--gradient-primary);
            border: none;
            color: white;
            padding: 1rem 2rem;
            border-radius: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .checkout-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .checkout-btn:hover::before {
            left: 100%;
        }

        .checkout-btn:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }

        .shipping-note {
            text-align: center;
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-top: 1rem;
            font-style: italic;
        }

        /* Empty Cart Styles */
        .empty-cart {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            padding: 4rem 2rem;
            text-align: center;
            border: 1px solid var(--border-color);
        }

        .empty-cart-icon {
            font-size: 4rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
        }

        .empty-cart h2 {
            font-size: 2rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .empty-cart p {
            color: var(--text-secondary);
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        .continue-shopping {
            background: var(--gradient-primary);
            border: none;
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
        }

        .continue-shopping:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
            color: white;
        }

        /* Animations */
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

        .cart-items,
        .cart-summary,
        .empty-cart {
            animation: fadeInUp 0.6s ease-out;
        }

        .cart-item {
            animation: fadeInUp 0.6s ease-out;
            animation-fill-mode: both;
        }

        .cart-item:nth-child(1) {
            animation-delay: 0.1s;
        }

        .cart-item:nth-child(2) {
            animation-delay: 0.2s;
        }

        .cart-item:nth-child(3) {
            animation-delay: 0.3s;
        }

        .cart-item:nth-child(4) {
            animation-delay: 0.4s;
        }

        .cart-item:nth-child(5) {
            animation-delay: 0.5s;
        }
    </style>

    <link rel="stylesheet" href="assets/css/vendor.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="body-wrapper">
        <!-- include header.php -->
        <?php include("components/header.php"); ?>
        <!-- include header.php end -->

        <!-- Modern Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title">
                    <i class="fas fa-shopping-cart" style="font-size: 2rem;"></i>
                    Shopping Cart
                </h1>
                <nav class="breadcrumb-modern">
                    <ol class="breadcrumb">
                        <li class=""><a href="./"><i class="fas fa-home"></i> Home</a></li>
                        <li class=" active">Cart</li>
                    </ol>
                </nav>
            </div>
        </div>

        <main id="MainContent" class="content-for-layout">
            <div class="container-modern">
                <?php if (mysqli_num_rows($checkCart) > 0): ?>
                    <div class="cart-container">
                        <!-- Cart Items -->
                        <div class="cart-items">
                            <div class="cart-header d-flex justify-content-between">
                                <h2>
                                    <i class="fas fa-list-ul"></i>
                                    Your Items (<?= count($items) ?>)
                                </h2>
                                <a href="shop.php" class="btn btn-success btn-sm">Continue Shopping</a>
                            </div>

                            <?php
                            $subtotal = 0;
                            $discount = 0;
                            $total = 0;
                            $shipping = 0;
                            $payment_total = 0;
                            foreach ($items as $item):
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
                                <div class="cart-item">
                                    <div class="item-content">
                                        <div class="item-image">
                                            <img src="uploads/<?= $product["image"]; ?>" alt="<?= $product["name"]; ?>">
                                        </div>

                                        <div class="item-details">
                                            <h3>
                                                <a href="product.php?pid=<?= $product['productid']; ?>">
                                                    <?= $product["name"]; ?>
                                                </a>
                                            </h3>
                                            <div class="item-tags">
                                                <i class="fas fa-tag" style="font-size: 0.75rem;"></i>
                                                <?= $product["tags"]; ?>
                                            </div>
                                            <div style="color: var(--text-secondary); font-size: 0.95rem;">
                                                <i class="fas fa-cube"></i>
                                                Quantity: <strong><?= $item["quantity"]; ?></strong>
                                            </div>
                                        </div>

                                        <div class="item-actions">
                                            <div class="item-price">₦<?= number_format($diff); ?></div>
                                            <a href="remove-from-cart.php?uid=<?= $item['userid']; ?>&pid=<?= $item['productid']; ?>"
                                                class="remove-btn">
                                                <i class="fas fa-trash-alt"></i>
                                                Remove
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;

                            if ($total <= 20000) {
                                $shipping = 1500;
                            } elseif ($total <= 5000) {
                                $shipping = 2500;
                            } else {
                                $shipping = 5000;
                            }
                            $payment_total = $subtotal + $shipping;
                            ?>
                        </div>

                        <!-- Cart Summary -->
                        <div class="cart-summary">
                            <div class="summary-header">
                                <h3>
                                    <i class="fas fa-calculator"></i>
                                    Order Summary
                                </h3>
                            </div>

                            <div class="summary-content">
                                <div class="summary-row">
                                    <span>Amount:</span>
                                    <span>₦<?= number_format($total); ?></span>
                                </div>

                                <div class="summary-row">
                                    <span>Subtotal:</span>
                                    <span>₦<?= number_format($subtotal); ?></span>
                                </div>

                                <div class="summary-row">
                                    <span>
                                        <i class="fas fa-percent" style="color: var(--accent-color);"></i>
                                        Discount:
                                    </span>
                                    <span style="color: var(--accent-color);">-₦<?= number_format($discount); ?></span>
                                </div>

                                <div class="summary-row">
                                    <span>
                                        <i class="fas fa-shipping-fast"></i>
                                        Shipping:
                                    </span>
                                    <span>₦<?= number_format($shipping); ?></span>
                                </div>

                                <div class="summary-row total">
                                    <span>Total:</span>
                                    <span>₦<?= number_format($payment_total); ?></span>
                                </div>

                                <form method="post" action="checkout.php">
                                    <?php $a = json_encode($items); ?>
                                    <textarea name="items" hidden><?= $a; ?></textarea>
                                    <input type="hidden" name="amount" value="<?= $payment_total; ?>">
                                    <button type="submit" class="checkout-btn">
                                        <i class="fas fa-lock"></i>
                                        Proceed to Checkout
                                    </button>
                                </form>

                                <p class="shipping-note">
                                    <i class="fas fa-info-circle"></i>
                                    Shipping & taxes calculated at checkout
                                </p>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="empty-cart">
                        <div class="empty-cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h2>Your Cart is Empty</h2>
                        <p>Looks like you haven't added any items to your cart yet. Start shopping to fill it up!</p>
                        <a href="shop.php" class="continue-shopping">
                            <i class="fas fa-store"></i>
                            Continue Shopping
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </main>

        <!-- include footer -->
        <?php include("components/footer.php"); ?>
        <!-- include footer end -->

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- all js -->
        <script src="assets/js/vendor.js"></script>
        <script src="assets/js/main.js"></script>
    </div>
</body>

</html>