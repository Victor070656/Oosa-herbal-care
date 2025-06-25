<?php
include_once "../config.php";
session_start();
if (!isset($_SESSION["admin"])) {
  echo "<script>location.href='login.php'</script>";
}

if (isset($_GET["s"])) {
  $s = $_GET["s"];
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
  <title>Product Categories</title>

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
                <h4 class="mb-3">Product Categories</h4>
                <div class="row">
                  <div class="col-12 mb-4">
                    <form method="post">

                      <input type="text" name="category" class="form-control mb-3" placeholder="Add a category">
                      <button class="btn btn-primary" name="add" type="submit">&plus; Add Category</button>
                      <?php
                      if (isset($_POST["add"])) {
                        $category = htmlspecialchars($_POST["category"]);

                        $addCategory = mysqli_query($conn, "INSERT INTO `categories` (`category_name`) VALUES ('$category')");

                        if ($addCategory) {

                          echo "<script>alert('Successfully added ✅'); location.href='product-category.php'</script>";
                        } else {
                          echo "<script>alert('An error occured ❌')</script>";
                        }
                      }
                      ?>
                    </form>
                  </div>
                </div>

                <div class="row">
                  <div class="table-responsive">
                    <table class="table invoice-table">
                      <thead>
                        <tr class="fw-bold">
                          <th scope="col">Category Name</th>
                          <th scope="col">Date</th>
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if (isset($s)) {
                          $getCategory = mysqli_query($conn, "SELECT * FROM `categories` WHERE (`category_name` LIKE '%$s%') ORDER BY `id` DESC");
                        } else {
                          $getCategory = mysqli_query($conn, "SELECT * FROM `categories` ORDER BY `id` DESC");
                        }

                        if (mysqli_num_rows($getCategory) > 0):
                          while ($product = mysqli_fetch_assoc($getCategory)):
                            $category = (object) $product;
                            ?>
                            <tr>
                              <td><?= $category->category_name; ?></td>

                              <td><?= $category->created_at; ?></td>
                              <td>
                                <a href="edit-product-category.php?pid=<?= $category->id; ?>"><i
                                    data-feather="edit"></i></a>
                                <!-- <a href="#"><i data-feather="eye"></i></a> -->
                                <a href="delete-product-category.php?pid=<?= $category->id; ?>"><i
                                    data-feather="trash"></i></a>
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