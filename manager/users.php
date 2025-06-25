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
  $getUsers = mysqli_query($conn, "SELECT * FROM `users` WHERE (`userid` LIKE '%$s%') OR (`firstname` LIKE '%$s%') OR (`lastname` LIKE '%$s%') OR (`username` LIKE '%$s%') OR (`phone` LIKE '%$s%') OR (`email` LIKE '%$s%') ORDER BY `id` DESC");
} else {
  $getUsers = mysqli_query($conn, "SELECT * FROM `users` ORDER BY `id` DESC");
}

$users = mysqli_fetch_all($getUsers, MYSQLI_ASSOC);
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
  <title>Users</title>

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
  <div class="loader">
    <div class="spinner-grow text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>

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
                    <h4>All Users</h4>
                  </div>
                </div>

                <div class="row">
                  <div class="table-responsive">
                    <table class="table invoice-table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Full Name</th>
                          <th scope="col">Username</th>
                          <th scope="col">Phone Number</th>
                          <th scope="col">Email</th>
                          <th scope="col">Reg. Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        foreach ($users as $user) {
                          ?>
                          <tr>
                            <th scope="row"><?= $user["userid"]; ?></th>
                            <td><?= $user["firstname"] . " " . $user["lastname"]; ?></td>
                            <td><?= $user["username"]; ?></td>
                            <td><?= $user["phone"]; ?></td>
                            <td><?= $user["email"]; ?></td>
                            <td><?= $user["created_at"]; ?></td>
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