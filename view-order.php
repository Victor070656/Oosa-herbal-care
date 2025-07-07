<?php
include_once("functions.php");
session_start();

if (!isset($_SESSION["user"])) {
    echo "<script>location.href='login.php'</script>";
} else {
    $userid = $_SESSION["user"]["userid"];
}

if (isset($_GET["oid"])) {
    $orderid = $_GET["oid"];
} else {
    echo "<script>location.href='orders.php'</script>";
}

$getOrders = mysqli_query($conn, "SELECT * FROM `orders` WHERE `orderid` = '$orderid'");
$orders = mysqli_fetch_assoc($getOrders);
?>
<!doctype html>
<html lang="en">

<head>
    <title>Oosa Herbal Care || Order Details</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Oosa Herbal Care - Order Details">
    <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #2e7d32;
            --secondary-color: #4caf50;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --info-color: #17a2b8;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }

        body {
            font-family: 'Poppins', sans-serif !important;
            background-color: #f5f7fa;
            color: #333;
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 60px 0 40px;
            margin-bottom: 30px;
        }

        .custom-breadcrumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 25px;
            padding: 8px 20px;
            margin-bottom: 20px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .custom-breadcrumb a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .custom-breadcrumb a:hover {
            color: white;
        }

        .custom-breadcrumb .separator {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.8rem;
        }

        .custom-breadcrumb .current {
            color: white;
            font-weight: 500;
        }

        .order-summary-card {
            background: white;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .order-header {
            background: linear-gradient(45deg, #f8f9fa, #e9ecef);
            padding: 30px;
            border-bottom: 1px solid #dee2e6;
        }

        .order-id {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .status-badge {
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: capitalize;
            display: inline-block;
            margin-bottom: 15px;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-processing {
            background-color: #cce5ff;
            color: #004085;
        }

        .status-shipped {
            background-color: #d4edda;
            color: #155724;
        }

        .status-delivered {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .delivery-info {
            background: linear-gradient(45deg, #e8f5e8, #f1f8e9);
            border-left: 4px solid var(--primary-color);
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .delivery-dates {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .product-item {
            background: white;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            margin-bottom: 20px;
            padding: 25px;
            transition: all 0.3s ease;
        }

        .product-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid #f8f9fa;
        }

        .product-info h5 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .product-tags {
            background: #f8f9fa;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            color: #6c757d;
            display: inline-block;
        }

        .order-date {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 12px 20px;
            border-radius: 25px;
            font-weight: 600;
            text-align: center;
            box-shadow: 0 4px 15px rgba(46, 125, 50, 0.2);
        }

        .back-btn {
            background: linear-gradient(45deg, #6c757d, #495057);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }

        .back-btn:hover {
            transform: scale(1.05);
            color: white;
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        }

        .progress-tracker {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        }

        .progress-step {
            text-align: center;
            position: relative;
        }

        .progress-step::before {
            content: '';
            position: absolute;
            top: 25px;
            left: 50%;
            width: 100%;
            height: 3px;
            background: #dee2e6;
            z-index: 1;
        }

        .progress-step:last-child::before {
            display: none;
        }

        .progress-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #dee2e6;
            color: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .progress-step.active .progress-icon {
            background: var(--primary-color);
            color: white;
        }

        .progress-step.completed .progress-icon {
            background: var(--success-color);
            color: white;
        }

        .progress-step.completed::before {
            background: var(--success-color);
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 40px 0 30px;
            }

            .order-header {
                padding: 20px;
            }

            .product-item {
                padding: 20px;
            }

            .product-image {
                width: 80px;
                height: 80px;
            }
        }
    </style>
    <link rel="stylesheet" href="assets/css/vendor.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <!-- Include Header -->
    <?php include("components/header.php"); ?>

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <nav aria-label="breadcrumb">
                <div class="custom-breadcrumb">
                    <a href="/"><i class="fas fa-home me-1"></i>Home</a>
                    <span class="separator">></span>
                    <a href="orders.php">Orders</a>
                    <span class="separator">></span>
                    <span class="current">Order Details</span>
                </div>
            </nav>
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-6 fw-bold mb-0">Order Details</h1>
                    <p class="lead mb-0">View your order information and track progress</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <i class="fas fa-receipt" style="font-size: 4rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mb-5">
        <a href="orders.php" class="back-btn">
            <i class="fas fa-arrow-left me-2"></i>
            Back to Orders
        </a>

        <!-- Order Summary Card -->
        <div class="order-summary-card">
            <div class="order-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="order-id">#<?= $orders["orderid"]; ?></div>
                        <div class="d-flex flex-column align-items-start">

                            <span
                                class="status-badge bg-success text-light">
                                <?php
                                $statusIcons = [
                                    'pending' => 'clock',
                                    'processing' => 'cog',
                                    'shipped' => 'truck',
                                    'delivered' => 'check-circle',
                                    'cancelled' => 'times-circle'
                                ];
                                $status = strtolower($orders['status']);
                                $icon = $statusIcons[$status] ?? 'info-circle';
                                ?>
                                <i class="fas fa-<?= $icon ?> me-2"></i>
                                <?= ucfirst($orders["status"]); ?>
                            </span>
                            <small><b>Payment method:</b> <?= $orders["payment_type"] ?></small>
                        </div>

                        <?php
                        $date1 = new DateTime($orders["created_at"]);
                        $date2 = new DateTime($orders["created_at"]);
                        $date1->modify("+ 14 days");
                        $date2->modify("+ 28 days");
                        $first_date = $date1->format("D, M d, Y");
                        $second_date = $date2->format("D, M d, Y");
                        ?>

                        <div class="delivery-info">
                            <h6><i class="fas fa-truck me-2"></i>Estimated Delivery</h6>
                            <div class="delivery-dates">
                                Between <strong><?= $first_date; ?></strong> and <strong><?= $second_date; ?></strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <div class="order-date">
                            <i class="fas fa-calendar-alt me-2"></i>
                            <?= date("M d, Y \a\\t g:i A", strtotime($orders["created_at"])); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Progress Tracker -->
        <div class="progress-tracker">
            <h5 class="mb-4"><i class="fas fa-route me-2"></i>Order Progress</h5>
            <div class="row">
                <?php
                $currentStatus = strtolower($orders['status']);
                $statuses = ['in queue', 'processing', 'shipped', 'delivered'];
                $statusLabels = ['Order Placed', 'Processing', 'Shipped', 'Delivered'];
                $statusIcons = ['shopping-cart', 'cog', 'truck', 'check-circle'];

                foreach ($statuses as $index => $status) {
                    $isActive = $status === $currentStatus;
                    $isCompleted = array_search($currentStatus, $statuses) > $index;
                    $stepClass = $isActive ? 'active' : ($isCompleted ? 'completed' : '');
                    ?>
                    <div class="col-3">
                        <div class="progress-step <?= $stepClass ?>">
                            <div class="progress-icon">
                                <i class="fas fa-<?= $statusIcons[$index] ?>"></i>
                            </div>
                            <div class="progress-label"><?= $statusLabels[$index] ?></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- Order Items -->
        <div class="row">
            <div class="col-12">
                <h4 class="mb-4"><i class="fas fa-box-open me-2"></i>Order Items</h4>

                <?php
                $items = json_decode($orders["items"], true);
                for ($i = 0; $i < count($items); $i++) {
                    $productid = $items[$i]["productid"];
                    $getProduct = mysqli_query($conn, "SELECT * FROM `products` WHERE `productid` = '$productid'");
                    $product = mysqli_fetch_assoc($getProduct);
                    ?>
                    <div class="product-item">
                        <div class="row align-items-center">
                            <div class="col-md-2 col-sm-3 text-center mb-3 mb-md-0">
                                <img src="uploads/<?= $product['image']; ?>" alt="<?= $product['name']; ?>"
                                    class="product-image">
                            </div>
                            <div class="col-md-6 col-sm-9">
                                <div class="product-info">
                                    <h5><?= $items[$i]["quantity"] . "x " . $product["name"]; ?></h5>
                                    <div class="product-tags">
                                        <i class="fas fa-tags me-1"></i>
                                        <?= $product["tags"]; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                <div class="d-flex flex-column align-items-md-end">
                                    <div class="mb-2">
                                        <span class="text-muted">Quantity:</span>
                                        <span class="fw-bold ms-1"><?= $items[$i]["quantity"]; ?></span>
                                    </div>
                                    <?php if (isset($product['price'])): ?>
                                        <div class="mb-2">
                                            <span class="text-muted">Price:</span>
                                            <span class="fw-bold ms-1">₦<?= number_format($product['price'], 2); ?></span>
                                        </div>
                                        <div>
                                            <span class="text-muted">Subtotal:</span>
                                            <span
                                                class="fw-bold ms-1 text-primary">₦<?= number_format($product['price'] * $items[$i]["quantity"], 2); ?></span>
                                        </div>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- Order Actions -->
        <div class="row mt-4">
            <!-- <div class="col-md-6">
                <div class="d-flex gap-3">
                    <?php if (strtolower($orders['status']) === 'pending'): ?>
                        <button class="btn btn-outline-danger">
                            <i class="fas fa-times me-2"></i>
                            Cancel Order
                        </button>
                    <?php endif; ?>

                    <button class="btn btn-outline-primary">
                        <i class="fas fa-download me-2"></i>
                        Download Receipt
                    </button>
                </div>
            </div> -->
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <button class="btn btn-primary">
                    <i class="fas fa-headset me-2"></i>
                    Contact Support
                </button>
            </div>
        </div>
    </div>

    <!-- Include Footer -->
    <?php include("components/footer.php"); ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Add smooth animations
        document.addEventListener('DOMContentLoaded', function () {
            // Animate product items
            const productItems = document.querySelectorAll('.product-item');
            productItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';

                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Animate progress tracker
            const progressSteps = document.querySelectorAll('.progress-step');
            progressSteps.forEach((step, index) => {
                setTimeout(() => {
                    step.style.opacity = '1';
                    step.style.transform = 'scale(1)';
                }, index * 200);
            });
        });
    </script>
</body>

</html>