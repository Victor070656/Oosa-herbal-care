<?php
include_once "../config.php";
session_start();
if (!isset($_SESSION["admin"])) {
  echo "<script>location.href='login.php'</script>";
}
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
  <title>Testimonials</title>

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
  <!-- <div class="loader">
    <div class="spinner-grow text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div> -->

  <div class="page-container">
    <?php include("components/menu.php"); ?>
    <div class="page-content">
      <div class="main-wrapper">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Add Testimonial</h5>
                <form method="post">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Name</label>
                      <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Position</label>
                      <input type="text" name="position" class="form-control" placeholder="Manager" required>
                    </div>
                    <div class="col-12 mb-3">
                      <label class="form-label">Message</label>
                      <textarea name="message" id="" class=" form-control " required></textarea>
                    </div>

                    <div class="col-12 mb-3">
                      <input type="submit" name="add" value="Add Testimonial" class="btn btn-primary">
                    </div>
                  </div>
                  <!-- Add products -->
                  <?php
                  if (isset($_POST["add"])) {
                    $name = htmlspecialchars($_POST["name"]);
                    $position = htmlspecialchars($_POST["position"]);
                    $message = htmlspecialchars($_POST["message"]);


                    $addTestimony = mysqli_query($conn, "INSERT INTO `testimonials` (`name`, `position`, `message`) 
                    VALUES ('$name', '$position', '$message')");

                    if ($addTestimony) {
                      echo "<script>alert('Successfully added ✅'); location.href='testimonials.php'</script>";
                    } else {
                      echo "<script>alert('An error occured ❌')</script>";
                    }
                  }
                  ?>
                </form>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table invoice-table">
                    <thead>
                      <tr class="text-nowrap">
                        <th scope="col">Name</th>
                        <th scope="col">Position</th>
                        <th scope="col text-truncate">Message</th>
                        <th scope="col">Date</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (isset($s)) {
                        $getTestimony = mysqli_query($conn, "SELECT * FROM `testimonials` WHERE (`name` LIKE '%$s%') OR (`position` LIKE '%$s%') OR (`message` LIKE '%$s%') ORDER BY `id` DESC");
                      } else {
                        $getTestimony = mysqli_query($conn, "SELECT * FROM `testimonials` ORDER BY `id` DESC");
                      }

                      if (mysqli_num_rows($getTestimony) > 0):
                        while ($testimony = mysqli_fetch_assoc($getTestimony)):
                          $testimony = (object) $testimony;
                          ?>
                          <tr>

                            <td><?= $testimony->name; ?></td>
                            <td><?= $testimony->position; ?></td>
                            <td class="text-truncate"><?= $testimony->message; ?></td>
                            <td class="text-nowrap"><?= date("d-m-Y h:i", strtotime($testimony->created_at)); ?></td>
                            <td>
                              <a href="edit-testimony.php?tid=<?= $testimony->id; ?>"><i data-feather="edit"></i></a>
                              <!-- <a href="#"><i data-feather="eye"></i></a> -->
                              <a href="delete-testimony.php?tid=<?= $testimony->id; ?>"><i data-feather="trash"></i></a>
                            </td>
                          </tr>
                          <?php
                        endwhile;
                      endif;
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