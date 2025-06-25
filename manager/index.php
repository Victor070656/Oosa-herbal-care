<?php
include_once "../config.php";
session_start();
if (!isset($_SESSION["admin"])) {
  echo "<script>location.href='login.php'</script>";
}

$getOrders = mysqli_query($conn, "SELECT * FROM `orders` ORDER BY `id` DESC LIMIT 5");
$getAllOrders = mysqli_query($conn, "SELECT * FROM `orders`");
$getAllUsers = mysqli_query($conn, "SELECT * FROM `users`");
$getAllProducts = mysqli_query($conn, "SELECT * FROM `products`");
$getRevenue = mysqli_query($conn, "SELECT SUM(`amount`) as rev FROM `orders`");
$getRev = mysqli_fetch_assoc($getRevenue);
$rev = $getRev["rev"] ?? 0;

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Oosa Herbal Care Dashboard">
  <meta name="keywords" content="admin,dashboard">
  <meta name="author" content="stacks">
  <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <!-- Title -->
  <title>Dashboard</title>

  <!-- Styles -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&amp;display=swap" rel="stylesheet">
  <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
  <link href="assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
  <link href="assets/plugins/apexcharts/apexcharts.css" rel="stylesheet">


  <!-- Theme Styles -->
  <link href="assets/css/main.min.css" rel="stylesheet">
  <link href="assets/css/custom.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>

  <div class="page-container">
    <!-- menu -->
    <?php include("components/menu.php"); ?>
    <!-- menu end -->
    <div class="page-content">
      <div class="main-wrapper">
        <div class="row">
          <div class="col-md-6 col-xl-3">
            <div class="card stat-widget border-start border-success border-3   ">
              <div class="card-body">
                <h5 class="card-title">Users</h5>
                <h2><?= $getAllUsers->num_rows; ?></h2>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-3">
            <div class="card stat-widget border-start border-success border-3 ">
              <div class="card-body">
                <h5 class="card-title">Products</h5>
                <h2><?= $getAllProducts->num_rows; ?></h2>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-3">
            <div class="card stat-widget border-start border-success border-3 ">
              <div class="card-body">
                <h5 class="card-title">Orders</h5>
                <h2><?= $getAllOrders->num_rows; ?></h2>

              </div>
            </div>
          </div>
          <div class="col-md-6 col-xl-3">
            <div class="card stat-widget border-start border-success border-3 ">
              <div class="card-body">
                <h5 class="card-title">Revenue</h5>
                <h2>₦<?= number_format($rev); ?></h2>

              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-8">
                    <h4>Recent Orders</h4>
                  </div>
                </div>

                <div class="row">
                  <div class="table-responsive">
                    <table class="table invoice-table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Client</th>
                          <th scope="col">Order Date</th>
                          <th scope="col">Amount</th>
                          <th scope="col">Status</th>
                          <!--                          <th scope="col">Actions</th>-->
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if (mysqli_num_rows($getOrders) > 0) {
                          $orders = mysqli_fetch_all($getOrders, MYSQLI_ASSOC);
                          foreach ($orders as $order) {
                            $userid = $order["userid"];
                            $getUser = mysqli_query($conn, "SELECT * FROM `users` WHERE `userid` = '$userid'");
                            $user = mysqli_fetch_assoc($getUser);
                            ?>
                            <tr>
                              <th scope="row"><?= $order["orderid"]; ?></th>
                              <td><?= $user["username"]; ?></td>
                              <td><?= $order["created_at"]; ?></td>
                              <td>$<?= $order["amount"]; ?></td>
                              <td><span class="badge bg-primary"><?= $order["status"]; ?></span></td>
                              <!--<td>
                            <a href="#"><i data-feather="edit"></i></a>
                            <a href="#"><i data-feather="eye"></i></a>
                            <a href="#"><i data-feather="trash"></i></a>
                          </td>-->
                            </tr>
                            <?php
                          }
                        }
                        ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Javascripts -->
  <script src="assets/plugins/jquery/jquery-3.4.1.min.js"></script>
  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <script src="assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
  <script src="assets/plugins/apexcharts/apexcharts.min.js"></script>
  <script src="assets/js/main.min.js"></script>
  <script src="assets/js/pages/dashboard.js"></script>
</body>

<!-- Mirrored from polygons.space/circl/templates/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 28 May 2024 10:50:36 GMT -->

</html>