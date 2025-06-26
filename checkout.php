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

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

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
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #059669;
            --primary-dark: #047857;
            --primary-light: #d1fae5;
            --secondary-color: #6b7280;
            --accent-color: #f59e0b;
            --success-color: #10b981;
            --error-color: #ef4444;
            --warning-color: #f59e0b;

            --text-primary: #111827;
            --text-secondary: #6b7280;
            --text-muted: #9ca3af;

            --bg-primary: #ffffff;
            --bg-secondary: #f9fafb;
            --bg-card: #ffffff;
            --bg-input: #f9fafb;

            --border-color: #e5e7eb;
            --border-focus: #059669;

            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);

            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;

            --font-primary: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
            --font-secondary: 'Poppins', sans-serif !important;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-secondary) !important;
            font-size: 14px;
            line-height: 1.6;
            color: var(--text-primary);
            background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Modern Breadcrumb */
        .breadcrumb {
            background: var(--bg-primary);
            padding: 1rem 0;
            border-bottom: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
        }

        .breadcrumb ul {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .breadcrumb li {
            display: flex;
            align-items: center;
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        .breadcrumb li a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .breadcrumb li a:hover {
            color: var(--primary-dark);
        }

        .breadcrumb .icon-breadcrumb {
            width: 16px;
            height: 16px;
            margin: 0 0.25rem;
            opacity: 0.5;
        }

        /* Modern Checkout Layout */
        .checkout-page {
            padding: 3rem 0;
        }

        .checkout-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .checkout-title {
            font-family: var(--font-secondary);
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .checkout-subtitle {
            color: var(--text-secondary);
            font-size: 1.125rem;
        }

        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 3rem;
            align-items: start;
        }

        @media (max-width: 1024px) {
            .checkout-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }

        /* Modern Form Styling */
        .form-card {
            background: var(--bg-card);
            border-radius: var(--radius-xl);
            padding: 2rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        }

        .form-section-title {
            font-family: var(--font-secondary);
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-section-title i {
            color: var(--primary-color);
            font-size: 1.25rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .form-field {
            position: relative;
        }

        .form-field.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: var(--radius-md);
            background: var(--bg-input);
            font-size: 0.875rem;
            font-family: inherit;
            transition: all 0.2s ease;
            outline: none;
        }

        /* .form-input:focus {
            border-color: var(--border-focus);
            background: var(--bg-primary);
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
        }

        .form-input:invalid {
            border-color: var(--error-color);
        } */

        /* Modern Order Summary */
        .order-summary {
            background: var(--bg-card);
            border-radius: var(--radius-xl);
            padding: 2rem;
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--border-color);
            position: sticky;
            top: 2rem;
            overflow: hidden;
        }

        .order-summary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-color), var(--primary-color));
        }

        .summary-title {
            font-family: var(--font-secondary);
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1.5rem;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .summary-title i {
            color: var(--accent-color);
        }

        .summary-items {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .summary-label {
            font-weight: 500;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .summary-value {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 1rem;
        }

        .summary-total {
            background: linear-gradient(135deg, var(--primary-light), rgba(5, 150, 105, 0.1));
            margin: 1rem 0;
            padding: 1rem;
            border-radius: var(--radius-md);
            border: 2px solid var(--primary-color);
        }

        .summary-total .summary-label {
            color: var(--primary-dark);
            font-weight: 600;
            font-size: 1.125rem;
        }

        .summary-total .summary-value {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.25rem;
        }

        .shipping-note {
            background: var(--bg-secondary);
            padding: 1rem;
            border-radius: var(--radius-md);
            border-left: 4px solid var(--accent-color);
            margin: 1rem 0;
        }

        .shipping-note p {
            margin: 0;
            font-size: 0.875rem;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .shipping-note i {
            color: var(--accent-color);
        }

        /* Modern Button */
        .btn-checkout {
            width: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: var(--radius-md);
            font-size: 1rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .btn-checkout::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }

        .btn-checkout:hover::before {
            left: 100%;
        }

        .btn-checkout:active {
            transform: translateY(0);
        }

        /* Icons for different sections */
        .icon-shipping::before {
            content: '\f0d1';
        }

        .icon-summary::before {
            content: '\f0f6';
        }

        .icon-secure::before {
            content: '\f023';
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 0 0.5rem;
            }

            .checkout-title {
                font-size: 2rem;
            }

            .form-card,
            .order-summary {
                padding: 1.5rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .checkout-page {
                padding: 2rem 0;
            }
        }

        /* Animation */
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

        .form-card,
        .order-summary {
            animation: fadeInUp 0.6s ease-out;
        }

        .order-summary {
            animation-delay: 0.2s;
        }

        /* Security Badge */
        .security-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.5rem;
            background: rgba(16, 185, 129, 0.1);
            border-radius: var(--radius-md);
            margin-top: 1rem;
            font-size: 0.875rem;
            color: var(--success-color);
        }

        .security-badge i {
            color: var(--success-color);
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

        <!-- Modern breadcrumb -->
        <div class="breadcrumb">
            <div class="container">
                <ul>
                    <li><a href="./"><i class="fas fa-home"></i> Home</a></li>
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
                    <li><a href="cart.php">Cart</a></li>
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

        <main id="MainContent" class="content-for-layout">
            <div class="checkout-page">
                <div class="container">
                    <!-- Modern Header -->
                    <div class="checkout-header">
                        <h1 class="checkout-title">Secure Checkout</h1>
                        <p class="checkout-subtitle">Complete your order safely and securely</p>
                    </div>

                    <form method="post" action="pay.php">
                        <div class="checkout-grid">
                            <!-- Shipping Form -->
                            <div class="form-card">
                                <h2 class="form-section-title">
                                    <i class="fas fa-shipping-fast"></i>
                                    Shipping Information
                                </h2>

                                <textarea name="items" hidden="hidden"><?= $info["items"]; ?></textarea>
                                <input type="hidden" name="amount" value="<?= $topay; ?>" />

                                <div class="form-grid">
                                    <div class="form-field">
                                        <label class="form-label">First Name *</label>
                                        <input type="text" name="first-name" class="form-input" required
                                            placeholder="Enter your first name" />
                                    </div>

                                    <div class="form-field">
                                        <label class="form-label">Last Name *</label>
                                        <input type="text" name="last-name" class="form-input" required
                                            placeholder="Enter your last name" />
                                    </div>

                                    <div class="form-field">
                                        <label class="form-label">Email Address *</label>
                                        <input type="email" name="email" class="form-input" required
                                            placeholder="your@email.com" />
                                    </div>

                                    <div class="form-field">
                                        <label class="form-label">Phone Number *</label>
                                        <input type="tel" name="phone" class="form-input" required
                                            placeholder="+234 000 000 0000" />
                                    </div>

                                    <div class="form-field">
                                        <label class="form-label">Country *</label>
                                        <input type="text" name="country" class="form-input" required
                                            placeholder="Nigeria" value="Nigeria" />
                                    </div>

                                    <div class="form-field">
                                        <label class="form-label">City *</label>
                                        <input type="text" name="city" class="form-input" required
                                            placeholder="Enter your city" />
                                    </div>

                                    <div class="form-field">
                                        <label class="form-label">Zip Code *</label>
                                        <input type="text" name="zip" class="form-input" required
                                            placeholder="000000" />
                                    </div>

                                    <div class="form-field">
                                        <label class="form-label">Address Line 1 *</label>
                                        <input type="text" name="addr1" class="form-input" required
                                            placeholder="Street address" />
                                    </div>

                                    <div class="form-field full-width">
                                        <label class="form-label">Address Line 2</label>
                                        <input type="text" name="addr2" class="form-input"
                                            placeholder="Apartment, suite, etc. (optional)" />
                                    </div>
                                </div>
                            </div>

                            <!-- Order Summary -->
                            <div class="order-summary">
                                <h3 class="summary-title">
                                    <i class="fas fa-receipt"></i>
                                    Order Summary
                                </h3>

                                <div class="summary-items">
                                    <div class="summary-item">
                                        <span class="summary-label">
                                            <i class="fas fa-tag"></i>
                                            Amount
                                        </span>
                                        <span class="summary-value">₦<?= number_format($total); ?></span>
                                    </div>

                                    <div class="summary-item">
                                        <span class="summary-label">
                                            <i class="fas fa-percent"></i>
                                            Discount
                                        </span>
                                        <span class="summary-value" style="color: var(--success-color);">
                                            -₦<?= number_format($discount); ?>
                                        </span>
                                    </div>

                                    <div class="summary-item">
                                        <span class="summary-label">
                                            <i class="fas fa-calculator"></i>
                                            Subtotal
                                        </span>
                                        <span class="summary-value">₦<?= number_format($subtotal); ?></span>
                                    </div>

                                    <div class="summary-item">
                                        <span class="summary-label">
                                            <i class="fas fa-truck"></i>
                                            Shipping
                                        </span>
                                        <span class="summary-value">₦<?= number_format($shipping); ?></span>
                                    </div>
                                </div>

                                <div class="summary-item summary-total">
                                    <span class="summary-label">
                                        <i class="fas fa-credit-card"></i>
                                        Total Amount
                                    </span>
                                    <span class="summary-value">₦<?= number_format($topay); ?></span>
                                </div>

                                <div class="shipping-note">
                                    <p>
                                        <i class="fas fa-info-circle"></i>
                                        Shipping & taxes calculated at checkout
                                    </p>
                                </div>

                                <input type="submit" value="Proceed to Payment" class="btn-checkout">

                                <div class="security-badge">
                                    <i class="fas fa-shield-alt"></i>
                                    <span>Secured by SSL encryption</span>
                                </div>
                            </div>
                        </div>
                    </form>
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

        <script>
            // Enhanced form interactions
            document.addEventListener('DOMContentLoaded', function () {
                // Add focus effects to form inputs
                // const inputs = document.querySelectorAll('.form-input');
                // inputs.forEach(input => {
                //     input.addEventListener('focus', function () {
                //         this.parentElement.style.transform = 'translateY(-2px)';
                //         this.parentElement.style.transition = 'transform 0.2s ease';
                //     });

                //     input.addEventListener('blur', function () {
                //         this.parentElement.style.transform = 'translateY(0)';
                //     });
                // });

                // Add loading state to submit button
                const submitBtn = document.querySelector('.btn-checkout');
                const form = document.querySelector('form');

                form.addEventListener('submit', function () {
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                    submitBtn.disabled = true;
                });
            });
        </script>
    </div>
</body>

</html>