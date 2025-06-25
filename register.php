<?php
include_once("functions.php");
session_start();
?>
<!doctype html>
<html lang="en" class="no-js">


<!-- Mirrored from spreethemesprevious.github.io/bisum/html/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 May 2024 11:37:56 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <title>Oosa Herbal Care || Register</title>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Oosa Herbal Care">
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
                    <li>Register</li>
                </ul>
            </div>
        </div>
        <!-- breadcrumb end -->

        <main id="MainContent" class="content-for-layout">
            <div class="login-page mt-100">
                <div class="container">
                    <form method="post" class="login-form common-form mx-auto">
                        <?php
                        $userError = $emailError = $passwordError = "";
                        ?>
                        <div class="section-header mb-3">
                            <h2 class="section-heading text-center">Register</h2>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <fieldset>
                                    <label class="label">First name </label>
                                    <input type="text" name="first" placeholder="John" required />
                                </fieldset>
                            </div>
                            <div class="col-12">
                                <fieldset>
                                    <label class="label">Last name</label>
                                    <input type="text" name="last" placeholder="Doe" required />
                                </fieldset>
                            </div>
                            <div class="col-12">
                                <fieldset>
                                    <label class="label">Username <small
                                            class="text-danger"><?= $userError; ?></small></label>
                                    <input type="text" name="username" placeholder="john3591" required />
                                </fieldset>
                            </div>
                            <div class="col-12">
                                <fieldset>
                                    <label class="label">Phone Number</label>
                                    <input type="text" name="phone" placeholder="+234 80 ------" required />
                                </fieldset>
                            </div>
                            <div class="col-12">
                                <fieldset>
                                    <label class="label">Email address <small
                                            class="text-danger"><?= $emailError; ?></small></label>
                                    <input type="email" name="email" placeholder="abc@example.com" required />
                                </fieldset>
                            </div>
                            <div class="col-12">
                                <fieldset>
                                    <label class="label">Password <small
                                            class="text-danger"><?= $passwordError; ?></small></label>
                                    <input type="password" name="password" placeholder="******" required />
                                </fieldset>
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" name="create"
                                    class="btn-primary d-block mt-3 btn-signin">CREATE</button>
                            </div>
                        </div>

                        <!-- process the form -->
                        <?php
                        if (isset($_POST["create"])) {
                            $userid = rand(10000000, 99999999);
                            $first = $_POST["first"];
                            $last = $_POST["last"];
                            $username = $_POST["username"];
                            $phone = $_POST["phone"];
                            $email = $_POST["email"];
                            $password = $_POST["password"];


                            $checkUser = mysqli_query($conn, "SELECT * FROM `users` WHERE `username`='$username'");
                            $checkEmail = mysqli_query($conn, "SELECT * FROM `users` WHERE `email`='$email'");
                            if (mysqli_num_rows($checkUser) > 0) {
                                echo "<script>alert('Username already in use!')</script>";
                            } elseif (strlen(trim($username)) < 6) {
                                echo "<script>alert('Username cannot be less than 6 characters!')</script>";
                            } elseif (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
                                echo "<script>alert('Invalid email format!')</script>";
                            } elseif (mysqli_num_rows($checkEmail) > 0) {
                                echo "<script>alert('Email already in use!')</script>";
                            } elseif (strlen(trim($password)) < 6) {
                                echo "<script>alert('Password cannot be less than 6 characters!')</script>";
                            } else {
                                $register = mysqli_query($conn, "INSERT INTO `users`(`userid`, `firstname`, `lastname`, `username`, `phone`, `email`, `password`)
                                VALUES('$userid','$first','$last','$username','$phone','$email','$password')");
                                if ($register) {
                                    echo "<script>alert('Registration successful ✅');location.href='login.php'</script>";
                                }
                            }
                        }
                        ?>
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
    </div>
</body>





</html>