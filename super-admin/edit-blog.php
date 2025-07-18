<?php
include_once "../config.php";
session_start();
if (!isset($_SESSION["admin"])) {
  echo "<script>location.href='login.php'</script>";
}

if (isset($_GET["bid"])) {
  $blogid = $_GET["bid"];
} else {
  echo "<script>location.href='blogs.php'</script>";
}


$getproducts = mysqli_query($conn, "SELECT * FROM `blogs` WHERE `id` = '$blogid'");
if (mysqli_num_rows($getproducts) > 0) {
  $product = mysqli_fetch_array($getproducts);
}
// var_dump($product);
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
  <title>Edit Blog</title>

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
          <div class="col">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Edit Blog</h5>
                <form method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-12 mb-3">
                      <label class="form-label">Title</label>
                      <input type="text" name="title" value="<?= $product["title"]; ?>" class="form-control"
                        placeholder="">
                    </div>
                    <div class="col-12 mb-3">
                      <label class="form-label">Tags</label>
                      <input type="text" name="tags" value="<?= $product["tags"]; ?>" class="form-control"
                        placeholder="Associated terms (Seperated by comma ' , ')">
                    </div>
                    <div class="col-12 mb-3">
                      <label class="form-label">Featured</label>
                      <select name="featured" id="" class="form-control form-select">
                        <option value="0" <?= $product["featured"] == 0 ? "selected" : "" ?>>No</option>
                        <option value="1" <?= $product["featured"] == 1 ? "selected" : "" ?>>Yes</option>
                      </select>
                    </div>
                    <div class="col-12 mb-3">
                      <label class="form-label">Content</label>
                      <textarea name="content" id="" class=" form-control "><?= $product["content"]; ?></textarea>
                    </div>
                    <div class="col-12 mb-3">
                      <label class="form-label">Blog image</label>
                      <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-12 mb-3">
                      <input type="submit" name="edit" value="Update Blog" class="btn btn-primary">
                    </div>
                  </div>
                  <!-- edit product -->
                  <?php
                  if (isset($_POST["edit"])) {
                    $title = htmlspecialchars($_POST["title"]);
                    $tags = htmlspecialchars($_POST["tags"]);
                    $featured = (int) htmlspecialchars($_POST["featured"]);
                    $content = htmlspecialchars($_POST["content"]);
                    $image = date("His") . $_FILES["image"]["name"];
                    $tmp_image = $_FILES["image"]["tmp_name"];
                    $location = "uploads/" . $image;


                    // var_dump($_FILES["image"]["name"] != "");
                    if ($_FILES["image"]["name"] == "") {
                      $editProduct = mysqli_query($conn, "UPDATE `blogs` SET `title`='$title', `tags`='$tags', `featured`={$featured}, `content`='$content' WHERE `id`='$blogid'");
                      if ($editProduct) {
                        echo "<script>alert('Successfully updated ✅'); location.href='blogs.php'</script>";
                      } else {
                        echo "<script>alert('An error occured ❌')</script>";
                      }
                    } else {
                      $editProduct = mysqli_query($conn, "UPDATE `blogs` SET `blogs` SET `title`='$title', `tags`='$tags', `featured`={$featured}, `content`='$content', `image`='$image' WHERE `id`='$blogid'");
                      if ($editProduct) {
                        move_uploaded_file($tmp_image, $location);
                        echo "<script>alert('Successfully updated ✅'); location.href='blogs.php'</script>";
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