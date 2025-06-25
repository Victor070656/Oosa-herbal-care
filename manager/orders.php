<?php
include_once "../config.php";
session_start();
if (!isset($_SESSION["admin"])) {
  echo "<script>location.href='login.php'</script>";
}
if (isset($_GET["s"])) {
  $s = $_GET["s"];
}
if (isset($s)) {
  $getOrders = mysqli_query($conn, "SELECT * FROM `orders` WHERE (`orderid` LIKE '%$s%') OR (`userid` LIKE '%$s%') OR (`status` LIKE '%$s%') ORDER BY `id` DESC");
} else {
  $getOrders = mysqli_query($conn, "SELECT * FROM `orders` ORDER BY `id` DESC");
}

$getRate = mysqli_query($conn, "SELECT * FROM `rate`");
$rate = mysqli_fetch_assoc($getRate);

?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from polygons.space/circl/../templates/admin/blank-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 28 May 2024 10:50:44 GMT -->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Responsive Admin Dashboard Template">
  <meta name="keywords" content="admin,dashboard">
  <meta name="author" content="stacks">
  <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <!-- Title -->
  <title>Orders</title>

  <!-- Styles -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&amp;display=swap" rel="stylesheet">
  <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
  <link href="assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">


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
    <?php include("components/menu.php"); ?>
    <div class="page-content">
      <div class="main-wrapper">
        <!-- <div class="container mb-3 d-flex align-items-center ">
          <span class="me-3"><b>Dollar Rate: </b><?= $rate["rate"]; ?></span>
          <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalId">
            Update Dollar Rate
          </button>
        </div> -->
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-8">
                    <h4>All Orders</h4>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="card">
                      <div class="card-body">


                        <div class="row">
                          <div class="table-responsive">
                            <table class="table invoice-table">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Client</th>
                                  <th scope="col">Order Date</th>
                                  <th scope="col">Amount (₦)</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Actions</th>
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
                                      <td><?= number_format($order["amount"]); ?></td>
                                      <td><span class="badge bg-primary"><?= $order["status"]; ?></span></td>
                                      <td>
                                        <a href="view-order.php?oid=<?= $order['orderid']; ?>"><i
                                            data-feather="eye"></i></a>
                                      </td>
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
        </div>
      </div>

    </div>
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" style="backdrop-filter: blur(5px);" id="modalId" tabindex="-1" role="dialog"
      aria-labelledby="modalTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTitleId">
              Update Dollar Rate
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="post">
            <div class="modal-body">
              <div class="container-fluid">
                <input type="number" placeholder="₦ 1450" value="<?= $rate["rate"]; ?>" name="rate" class="form-control"
                  required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" name="update" class="btn btn-primary">Update</button>
            </div>
            <?php
            if (isset($_POST["update"])) {
              $dollar_rate = $_POST["rate"];

              $updateRate = mysqli_query($conn, "UPDATE `rate` SET `rate` = '$dollar_rate'");
              if ($updateRate) {
                echo "<script>alert('Updated Successfully ✅'); location.href='orders.php'</script>";
              } else {
                echo "<script>alert('Something went wrong'); location.href='orders.php'</script>";
              }
            }
            ?>
          </form>
        </div>
      </div>
    </div>

    <script>
      var modalId = document.getElementById('modalId');

      modalId.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        let button = event.relatedTarget;
        // Extract info from data-bs-* attributes
        let recipient = button.getAttribute('data-bs-whatever');

        // Use above variables to manipulate the DOM
      });
    </script>

  </div>

  <!-- Javascripts -->
  <script src="assets/plugins/jquery/jquery-3.4.1.min.js"></script>
  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <script src="assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
  <script src="assets/js/main.min.js"></script>
</body>

<!-- Mirrored from polygons.space/circl/templates/admin/blank-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 28 May 2024 10:50:44 GMT -->

</html>