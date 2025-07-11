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
?>
<!doctype html>
<html lang="en">

<head>
    <title>Oosa Herbal Ventures || My Orders</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Oosa Herbal Ventures - View Your Orders">
    <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
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


        .order-card {
            background: white;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            margin-bottom: 20px;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .order-header {
            background: linear-gradient(45deg, #f8f9fa, #e9ecef);
            padding: 20px;
            border-bottom: 1px solid #dee2e6;
        }

        .order-id {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .order-date {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .order-body {
            padding: 20px;
        }

        .status-badge {
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            text-transform: capitalize;
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

        .order-items {
            color: #495057;
            line-height: 1.6;
        }

        .view-order-btn {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .view-order-btn:hover {
            transform: scale(1.05);
            color: white;
            box-shadow: 0 4px 15px rgba(46, 125, 50, 0.3);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            color: #dee2e6;
        }

        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            margin-bottom: 30px;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .stats-label {
            color: #6c757d;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 40px 0 30px;
            }

            .order-header {
                padding: 15px;
            }

            .order-body {
                padding: 15px;
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
                    <a href="./"><i class="fas fa-home me-1"></i>Home</a>
                    <span class="separator">></span>
                    <span class="current">My Orders</span>
                </div>
            </nav>
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-5 fw-bold mb-0">My Orders</h1>
                    <p class="lead mb-0">Track and manage your orders</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <i class="fas fa-shopping-bag" style="font-size: 4rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mb-5">
        <?php if (count($orders) > 0): ?>
            <!-- Order Statistics -->
            <div class="row mb-4">
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card">
                        <div class="stats-number"><?= count($orders) ?></div>
                        <div class="stats-label">Total Orders</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card">
                        <div class="stats-number">
                            <?php
                            $pendingCount = 0;
                            foreach ($orders as $order) {
                                if (strtolower($order['status']) == 'pending' || strtolower($order['status']) == 'in queue')
                                    $pendingCount++;
                            }
                            echo $pendingCount;
                            ?>
                        </div>
                        <div class="stats-label">Pending</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card">
                        <div class="stats-number">
                            <?php
                            $deliveredCount = 0;
                            foreach ($orders as $order) {
                                if (strtolower($order['status']) == 'delivered')
                                    $deliveredCount++;
                            }
                            echo $deliveredCount;
                            ?>
                        </div>
                        <div class="stats-label">Delivered</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stats-card">
                        <div class="stats-number">
                            <?php
                            $thisMonth = date('Y-m');
                            $thisMonthCount = 0;
                            foreach ($orders as $order) {
                                if (date('Y-m', strtotime($order['created_at'])) == $thisMonth)
                                    $thisMonthCount++;
                            }
                            echo $thisMonthCount;
                            ?>
                        </div>
                        <div class="stats-label">This Month</div>
                    </div>
                </div>
            </div>

            <!-- Orders List -->
            <div class="row">
                <?php foreach ($orders as $order):
                    $items = json_decode($order["items"], true);
                    $statusClass = 'status-' . strtolower(str_replace(' ', '-', $order['status']));
                    ?>
                    <div class="col-12">
                        <div class="order-card">
                            <div class="order-header">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="order-id">#<?= $order["orderid"]; ?></div>
                                        <div class="order-date">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            <?= date("M d, Y \a\\t g:i A", strtotime($order["created_at"])); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6  text-md-end mt-2 mt-md-0">
                                        <div class="d-flex flex-column align-items-end">

                                            <span class="status-badge bg-success mb-2 text-light">
                                                <?php
                                                $statusIcons = [
                                                    'pending' => 'clock',
                                                    'processing' => 'cog',
                                                    'shipped' => 'truck',
                                                    'delivered' => 'check-circle',
                                                    'cancelled' => 'times-circle'
                                                ];
                                                $status = strtolower($order['status']);
                                                $icon = $statusIcons[$status] ?? 'info-circle';
                                                ?>
                                                <i class="fas fa-<?= $icon ?> me-1"></i>
                                                <?= ucfirst($order["status"]); ?>
                                            </span>
                                            <small>🧾 <?= $order["payment_type"] ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="order-body">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h6 class="mb-2">
                                            <i class="fas fa-box me-2 text-muted"></i>
                                            Order Items:
                                        </h6>
                                        <div class="order-items">
                                            <?php
                                            $itemStrings = [];
                                            for ($i = 0; $i < count($items); $i++) {
                                                $productid = $items[$i]["productid"];
                                                $getProduct = mysqli_query($conn, "SELECT * FROM `products` WHERE `productid` = '$productid'");
                                                $product = mysqli_fetch_assoc($getProduct);
                                                $itemStrings[] = $items[$i]["quantity"] . "x " . $product["name"];
                                            }
                                            echo implode(" • ", $itemStrings);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                        <a href="view-order.php?oid=<?= $order['orderid']; ?>" class="view-order-btn">
                                            <i class="fas fa-eye me-2"></i>
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <!-- Empty State -->
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="empty-state">
                        <i class="fas fa-shopping-bag"></i>
                        <h3>No Orders Yet</h3>
                        <p class="mb-4">You haven't placed any orders yet. Start shopping to see your orders here!</p>
                        <a href="/products" class="view-order-btn">
                            <i class="fas fa-shopping-cart me-2"></i>
                            Start Shopping
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Include Footer -->
    <?php include("components/footer.php"); ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        // Add smooth scrolling and animations
        document.addEventListener('DOMContentLoaded', function () {
            // Animate cards on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function (entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all order cards
            document.querySelectorAll('.order-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });
    </script>
</body>

</html>