<?php
include_once "../config.php";
session_start();
if (!isset($_SESSION["admin"])) {
    echo "<script>location.href='login.php'</script>";
}

if (isset($_GET["oid"])) {
    $orderid = $_GET["oid"];
} else {
    echo "<script>location.href='orders.php'</script>";
}

$getOrders = mysqli_query($conn, "SELECT * FROM `orders` WHERE `orderid` = '$orderid'");
$orders = mysqli_fetch_assoc($getOrders);

$date1 = new DateTime($orders["created_at"]);
$date2 = new DateTime($orders["created_at"]);
$date1->modify("+ 14 days");
$date2->modify("+ 28 days");
$first_date = $date1->format("D d F Y");
$second_date = $date2->format("D d F Y");



$options = [
    "In queue",
    "On preparation",
    "Ready for delivery",
    "Shipped",
    "Delivered"
];
?>

<!DOCTYPE html>
<html lang="en">


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
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <h3 class="fw-bold">Order #<?= $orders["orderid"]; ?></h3>
                                    </div>
                                    <div class="col-12">
                                        <p class="mb-1"><span class="fw-bold">Amount Paid:</span>
                                            $<?= $orders["amount"]; ?></p>
                                        <p class="mb-1"><span class="fw-bold">Status:</span> <?= $orders["status"]; ?>
                                        </p>
                                        <h6 class="mt-0 pt-0">Order to be delivered between <b><?= $first_date; ?></b>
                                            and <b><?= $second_date; ?></b></h6>

                                        <span class="text-decoration-underline text-secondary">Reciever Info</span>
                                        <p class="mb-1"><span class="fw-bold">Name:</span>
                                            <?= $orders["firstname"] . " " . $orders["lastname"]; ?></p>
                                        <p class="mb-1"><span class="fw-bold">Phone Number:</span>
                                            <?= $orders["phone"]; ?></p>
                                        <p class="mb-1"><span class="fw-bold">Email:</span> <?= $orders["email"]; ?></p>
                                        <p class="mb-1"><span class="fw-bold">Location:</span>
                                            <?= $orders["address1"] . ", " . $orders["city"] . ", " . $orders["country"]; ?>
                                        </p>

                                        <div class="btn-group mt-3">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modalId">
                                                Edit Status
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="card">
                                            <div class="card-body">


                                                <div class="row">
                                                    <div class="table-responsive">
                                                        <hr>
                                                        <table class="table invoice-table">

                                                            <tbody>
                                                                <?php



                                                                $a = $orders["items"];
                                                                $items = json_decode($a, true);
                                                                foreach ($items as $item) {
                                                                    $productid = $item["productid"];
                                                                    $getProduct = mysqli_query($conn, "SELECT * FROM `products` WHERE `productid` = '$productid'");
                                                                    $product = mysqli_fetch_assoc($getProduct);
                                                                    ?>
                                                                    <tr>
                                                                        <td scope="row">
                                                                            <img class="img-fluid"
                                                                                style="object-fit: contain"
                                                                                src="../uploads/<?= $product["image"]; ?>">
                                                                        </td>
                                                                        <td>
                                                                            <h4><?= $item["quantity"] . " " . $product["name"]; ?>
                                                                            </h4>
                                                                            <small><?= $product["tags"]; ?></small>
                                                                        </td>

                                                                    </tr>
                                                                    <?php
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

            <!-- Modal -->
            <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
                aria-hidden="true" style="backdrop-filter: blur(5px)">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">
                                Update the order status
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post">
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <select class="form-select" name="status">
                                        <?php
                                        foreach ($options as $option) {
                                            ?>
                                            <option <?= $option == $orders["status"] ? "selected" : ""; ?>><?= $option; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" name="update-status" class="btn btn-primary">Save</button>
                            </div>
                            <?php
                            if (isset($_POST["update-status"])) {
                                $status = $_POST["status"];

                                $updateStatus = mysqli_query($conn, "UPDATE `orders` SET `status` = '$status' WHERE `orderid` = '$orderid'");
                                if ($updateStatus) {
                                    echo "<script>alert('Status Updated!');location.href='view-order.php?oid=$orderid'</script>";
                                } else {
                                    echo "<script>alert('Something went wrong!')</script>";
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