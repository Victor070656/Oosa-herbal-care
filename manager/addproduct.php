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
  <title>Add Products</title>

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
                <h5 class="card-title">Add Product</h5>
                <form method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-12 mb-3">
                      <label class="form-label">Product Name</label>
                      <input type="text" name="name" class="form-control" placeholder="Beaded Wall clock ..." required>
                    </div>
                    <div class="col-12 mb-3">
                      <label class="form-label">Category</label>
                      <select name="category" id="" class="form-control form-select" required>
                        <option value="" selected hidden>Select Category</option>
                        <?php
                        $getCategory = mysqli_query($conn, "SELECT * FROM `categories`");
                        if (mysqli_num_rows($getCategory) > 0) {
                          while ($row = mysqli_fetch_assoc($getCategory)) {
                            echo "<option value='{$row["id"]}'>{$row["category_name"]}</option>";
                          }
                        } else {
                          echo "<option value='' disabled>No Category Found</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-12 mb-3">
                      <label class="form-label">Tags</label>
                      <input type="text" name="tags" class="form-control" required
                        placeholder="Associated terms (Seperated by comma ' , ')">
                    </div>

                    <div class="col-md-6 mb-3">
                      <label class="form-label">Price (₦)</label>
                      <input type="number" class="form-control" required name="price" placeholder="$500">
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Discount (%)</label>
                      <input type="number" step="any" name="discount" value="0" class="form-control" required
                        placeholder="5%">
                    </div>
                    <div class="col-12 mb-3">
                      <label class="form-label">Description</label>
                      <textarea name="description" id="" class=" form-control " required></textarea>
                    </div>
                    <div class="col-12 mb-3">
                      <label class="form-label">Product image</label>
                      <input type="file" name="image" class="form-control" required>
                    </div>
                    <div class="col-12 mb-3">
                      <input type="submit" name="add" value="Add Product" class="btn btn-primary">
                    </div>
                  </div>
                  <!-- Add products -->
                  <?php
                  if (isset($_POST["add"])) {
                    $productid = rand(100000, 999999);
                    $name = htmlspecialchars($_POST["name"]);
                    $category = htmlspecialchars($_POST["category"]);
                    $tags = htmlspecialchars($_POST["tags"]);
                    $price = htmlspecialchars($_POST["price"]);
                    $discount = htmlspecialchars($_POST["discount"]);
                    $description = htmlspecialchars($_POST["description"]);
                    $image = date("YmdHis") . $_FILES["image"]["name"];
                    $tmp_image = $_FILES["image"]["tmp_name"];
                    $location = "../uploads/" . $image;


                    $addProduct = mysqli_query($conn, "INSERT INTO `products` (`category_id`, `productid`, `name`, `tags`, `price`, `discount`, `description`, `image`) 
                    VALUES ('$category', '$productid','$name','$tags','$price','$discount','$description','$image')");

                    if ($addProduct) {
                      move_uploaded_file($tmp_image, $location);
                      echo "<script>alert('Successfully added ✅'); location.href='products.php'</script>";
                    } else {
                      echo "<script>alert('An error occured ❌')</script>";
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