<?php
include_once("functions.php");
session_start();

if (!isset($_SESSION["user"])) {
    echo "<script>location.href='login.php'</script>";
} else {
    $userid = $_SESSION["user"]["userid"];
    $email = $_SESSION["user"]["email"];
}



//dd($_POST);
if ($_POST) {
    $info = $_POST;
    // $_SESSION["pay"] = $_POST;
}

// $getRate = mysqli_query($conn, "SELECT * FROM `rate`");
// $rate = mysqli_fetch_assoc($getRate);

$amount = (float) round($info["amount"]);

// dd($_SESSION["pay"]);
?>
<!doctype html>
<html lang="en" class="no-js">



<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
    <title>Oosa Herbal Ventures || Pay</title>
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
                    <li>Checkout</li>
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
                    <li>Pay</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <main id="MainContent" class="content-for-layout">
            <div class="container checkout-page mt-100">
                <div class="card py-5 px-4" style="border-radius: 15px">
                    <div class="card-body text-center">
                        <h1 class=" mb-3">🏦</h1>
                        <h1 class="display-5 fw-bold ">0123456789</h1>
                        <h3 class="fw-bold ">Account Name</h3>
                        <h3 class="fw-bold ">Bank</h3>
                        <h4 class="">Your order costs: ₦<?= number_format($info["amount"]); ?></h4>
                        <div class="col-md-6 text-center mx-auto">

                            <form method="post">
                                <label for="" class="form-label">Transaction Reference number</label>
                                <input type="text" name="ref" required placeholder="Enter your transaction reference"
                                    id="" class="form-control text-center mb-3">
                                <button type="submit" name="pay_now" class="btn btn-primary">Confirm Payment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- paystack integration -->
            <?php
            if (isset($_POST['pay_now'])) {
                $data = $_SESSION["pay"];
                $ref = $_POST["ref"];
                $order_id = uniqid("OS-");
                $order_items = $data["items"];
                $order_amount = $data["amount"];
                $order_firstname = $data["first-name"];
                $order_lastname = $data["last-name"];
                $order_email = $data["email"];
                $order_phone = $data["phone"];
                $order_country = $data["country"];
                $order_city = $data["city"];
                $order_zip = $data["zip"];
                $order_address1 = $data["addr1"];
                $order_address2 = $data["addr2"];

                $emailBody = '
                    <!DOCTYPE html>
                <html>
                  <head>
                    <title>Email Template</title>
                    <style type="text/css">
                      body {
                        font-family: Arial, sans-serif;
                        line-height: 1.6;
                        color: #333;
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                      }
                      .header {
                        background-color: #02012b;
                        color: white;
                        padding: 10px;
                        text-align: center;
                        border-radius: 10px;
                      }
                      .content {
                        padding: 20px;
                        background-color: #f9f9f9;
                        border-radius: 10px;
                        margin-top: 10px;
                      }
                      .button {
                        display: inline-block;
                        padding: 10px 20px;
                        background-color: #02012b;
                        color: white;
                        text-decoration: none;
                        border-radius: 5px;
                        margin-top: 15px;
                      }
                    </style>
                  </head>
                  <body>
                    <div class="header">
                      <h1>Order Placed</h1>
                    </div>
                    <div class="content">
                      <p>Hello there,</p>
                      <p>An Order was just placed now (Via Bank Transfer) - Payment Reference: #' . $ref . '</p>
                      <p>To view the order details, please visit your dashboard</p>
                      <a href="https://aestheticsbylozik.com/manager" class="button"
                        >Go To Dashboard</a
                      >
                    </div>
                  </body>
                </html>
                
                    ';
                //    insert order
                $addOrder = mysqli_query($conn, "INSERT INTO `orders`(`orderid`, `userid`, `ref`, `payment_type`, `items`, `amount`, `firstname`, `lastname`, `email`, `phone`, `country`, `city`, `zipcode`, `address1`, `address2`) 
            VALUES ('$order_id', '$userid', '$ref', 'Bank', '$order_items', '$order_amount', '$order_firstname', '$order_lastname', '$order_email', '$order_phone', '$order_country', '$order_city', '$order_zip', '$order_address1', '$order_address2')");
                if ($addOrder) {
                    sendNotification("Someone Placed An Order", $emailBody);
                    $deleteCartItems = mysqli_query($conn, "DELETE FROM `cart` WHERE `userid` = '$userid'");
                    echo "<script>location.href='./'; alert('Order completed ✅')</script>";
                } else {
                    echo "<script>location.href='./'; alert('Order failed ❌')</script>";
                }
            }

            ?>
            <!-- paystack integration end -->
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


<!-- Mirrored from spreethemesprevious.github.io/bisum/html/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 May 2024 11:37:57 GMT -->

</html>