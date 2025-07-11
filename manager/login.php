<?php
include_once "../config.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from polygons.space/circl/../templates/admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 28 May 2024 10:50:44 GMT -->

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Responsive Admin Dashboard Template" />
  <meta name="keywords" content="admin,dashboard" />
  <meta name="author" content="stacks" />
  <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <!-- Title -->
  <title>Oosa Herbal Ventures Admin || Login</title>

  <!-- Styles -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&amp;display=swap" rel="stylesheet" />
  <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/plugins/font-awesome/css/all.min.css" rel="stylesheet" />
  <link href="assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet" />

  <!-- Theme Styles -->
  <link href="assets/css/main.min.css" rel="stylesheet" />
  <link href="assets/css/custom.css" rel="stylesheet" />

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-page">
  <div class="loader">
    <div class="spinner-grow text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-12 col-lg-4">
        <div class="card login-box-container">
          <div class="card-body">
            <div class="authent-logo">
              <img src="assets/images/logo%402x.png" alt="" />
            </div>
            <div class="authent-text">
              <p>Admin Login</p>
              <p>Please Sign-in to your account.</p>
            </div>

            <form method="post">
              <div class="mb-3">
                <div class="form-floating">
                  <input type="email" class="form-control" name="email" id="floatingInput"
                    placeholder="name@example.com" />
                  <label for="floatingInput">Email address</label>
                </div>
              </div>
              <div class="mb-3">
                <div class="form-floating">
                  <input type="password" class="form-control" name="password" id="floatingPassword"
                    placeholder="Password" />
                  <label for="floatingPassword">Password</label>
                </div>
              </div>
              <div class="d-grid">
                <button type="submit" name="login" class="btn btn-info m-b-xs">
                  Sign In
                </button>
              </div>
              <?php
              if (isset($_POST["login"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];

                $loginUser = mysqli_query($conn, "SELECT * FROM `admin` WHERE `email`='$email' AND `password`='$password'");
                if (mysqli_num_rows($loginUser) > 0) {
                  $_SESSION["admin"] = "admin";
                  echo "<script>alert('Login successful ✅'); location.href='./'</script>";
                } else {
                  echo "<script>alert('Wrong Login Credentials');</script>";
                }
              }
              ?>
            </form>
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
  <script src="assets/js/main.min.js"></script>
</body>

<!-- Mirrored from polygons.space/circl/templates/admin/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 28 May 2024 10:50:44 GMT -->

</html>