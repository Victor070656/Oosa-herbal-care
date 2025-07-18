<?php
include_once "../config.php";
session_start();
if (!isset($_SESSION["admin"])) {
  echo "<script>location.href='login.php'</script>";
}

if (isset($_GET["s"])) {
  $s = $_GET["s"];
}

if (isset($_GET["pid"])) {
  $id = $_GET["pid"];
} else {
  echo "<script>location.href='banners.php'</script>";
}

$getBanner = mysqli_query($conn, "SELECT * FROM `banners` WHERE `id` = '$id'");
if (mysqli_num_rows($getBanner) == 0) {
  echo "<script>location.href='banners.php'</script>";
  exit;
}

$ban = mysqli_fetch_assoc($getBanner);
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
  <title>Banners</title>

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
                <h4 class="mb-3">Edit Home Page Banners</h4>
                <div class="row">
                  <div class="col-12 mb-4">
                    <form method="post" enctype="multipart/form-data">
                      <div class="mb-2">
                        <label for="">Heading</label>
                        <input type="text" name="heading" value="<?= $ban['heading']; ?>" class="form-control mb-3"
                          required placeholder="Add a Heading">
                      </div>
                      <div class="mb-2">
                        <label for="">Subtitle</label>
                        <input type="text" name="subtitle" value="<?= $ban['subtitle']; ?>" class="form-control mb-3"
                          required placeholder="Add a Subtitle">
                      </div>
                      <div class="mb-2">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control mb-3">
                      </div>
                      <button class="btn btn-primary" name="add" type="submit">&plus; Update Banner</button>
                      <?php
                      if (isset($_POST["add"])) {
                        $heading = htmlspecialchars($_POST["heading"]);
                        $subtitle = htmlspecialchars($_POST["subtitle"]);
                        $image = time() . $_FILES["image"]["name"];
                        $image_tmp = $_FILES["image"]["tmp_name"];

                        $location = __DIR__ . "/../uploads/banner/" . $image;
                        if (isset($_FILES["image"]["name"]) && $_FILES["image"]["name"] != "") {
                          if (move_uploaded_file($image_tmp, $location)) {
                            $addBanner = mysqli_query($conn, "UPDATE `banners` SET `heading` = '$heading', `subtitle` = '$subtitle', `image` = '$image' WHERE `id` = '$id'");

                            if ($addBanner) {

                              echo "<script>alert('Successfully added ✅'); location.href='banners.php'</script>";
                            } else {
                              echo "<script>alert('An error occured ❌')</script>";
                            }
                          } else {
                            echo "<script>alert('Banner upload failed ❌')</script>";
                          }
                        } else {
                          $addBanner = mysqli_query($conn, "UPDATE `banners` SET `heading` = '$heading', `subtitle` = '$subtitle' WHERE `id` = '$id'");

                          if ($addBanner) {

                            echo "<script>alert('Successfully added ✅'); location.href='banners.php'</script>";
                          } else {
                            echo "<script>alert('An error occured ❌')</script>";
                          }
                        }
                      }
                      ?>
                    </form>
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