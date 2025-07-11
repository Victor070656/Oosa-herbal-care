<?php
include_once("functions.php");
session_start();

if (!isset($_SESSION["user"])) {
    echo "<script>location.href='login.php'</script>";
} else {
    $userid = $_SESSION["user"]["userid"];
}

$getUser = mysqli_query($conn, "SELECT * FROM `users` WHERE `userid`='$userid'");
$user = mysqli_fetch_array($getUser);
// var_dump($user);
?>
<!doctype html>
<html lang="en" class="no-js">


<!-- Mirrored from spreethemesprevious.github.io/bisum/htmllogin.php.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 May 2024 11:36:54 GMT -->
<!-- Added by HTTrack -->

<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
    <title>Oosa Herbal Ventures || User Profile</title>
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
                    <li>Profile</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <main id="MainContent" class="content-for-layout">
            <div class="container">
                <div class="row">

                    <div class="col-md-9 mx-auto mt-5">
                        <div class="card shadow-sm" style="border-radius: 15px;">
                            <div class="card-header"><b>Your Profile</b></div>
                            <div class="card-body">
                                <form method="post" class="">
                                    <div class="row">
                                        <div class="form-floating mb-3 col-md-6">
                                            <input type="text" class="form-control" value="<?= $user["firstname"]; ?>"
                                                name="first" required id="first" placeholder="" />
                                            <label>&nbsp; First Name</label>
                                        </div>
                                        <div class="form-floating mb-3 col-md-6">
                                            <input type="text" class="form-control" value="<?= $user["lastname"]; ?>"
                                                name="last" required id="last" placeholder="" />
                                            <label>&nbsp; Last Name</label>
                                        </div>
                                        <div class="form-floating mb-3 col-md-6">
                                            <input type="text" class="form-control" value="<?= $user["username"]; ?>"
                                                name="username" required id="username" placeholder="" />
                                            <label>&nbsp; Username</label>
                                        </div>
                                        <div class="form-floating mb-3 col-md-6">
                                            <input type="text" class="form-control" value="<?= $user["phone"]; ?>"
                                                name="phone" required id="phone" placeholder="" />
                                            <label>&nbsp; Phone Number <small>(E.g +234 -----)</small></label>
                                        </div>
                                        <div class="form-floating mb-3 col-md-6">
                                            <input type="text" class="form-control" value="<?= $user["email"]; ?>"
                                                name="email" required id="email" placeholder="" />
                                            <label>&nbsp; Email</label>
                                        </div>
                                        <div class="form-floating mb-3 col-md-6">
                                            <input type="text" class="form-control" value="<?= $user["password"]; ?>"
                                                name="password" required id="password" placeholder="" />
                                            <label>&nbsp; Password</label>
                                        </div>
                                    </div>
                                    <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
                                    <?php
                                    if (isset($_POST["update"])) {
                                        $first = $_POST["first"];
                                        $last = $_POST["last"];
                                        $username = $_POST["username"];
                                        $phone = $_POST["phone"];
                                        $email = $_POST["email"];
                                        $password = $_POST["password"];


                                        $updateProfile = mysqli_query($conn, "UPDATE `users` SET `firstname`='$first',`lastname`='$last',`username`='$username',`phone`='$phone',`email`='$email',`password`='$password' WHERE `userid`='$userid'");
                                        if ($updateProfile) {
                                            echo "<script>alert('Updated successfully ✅'); location.href='user-profile'</script>";
                                        } else {
                                            echo "<script>alert('An error occured ❌'); location.href='user-profile'</script>";
                                        }
                                    }
                                    ?>
                                </form>
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


<!-- Mirrored from spreethemesprevious.github.io/bisum/htmllogin.php.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 May 2024 11:36:54 GMT -->

</html>