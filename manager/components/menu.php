<div class="page-header">
    <nav class="navbar navbar-expand-lg d-flex justify-content-between">
        <div class="" id="navbarNav">
            <ul class="navbar-nav" id="leftNav">
                <li class="nav-item">
                    <a class="nav-link" id="sidebar-toggle" href="#"><i data-feather="arrow-left"></i></a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Help</a>
                </li> -->
            </ul>
        </div>
        <div class="logo">
            <a class="" href="index.php">
                <img src="../assets/images/logo2.png" alt="" style="height: 45px; border-radius: 8px;">
            </a>
        </div>
        <div class="" id="headerNav">
            <ul class="navbar-nav">
                <?php if (basename($_SERVER["SCRIPT_NAME"]) == "products.php" || basename($_SERVER["SCRIPT_NAME"]) == "orders.php" || basename($_SERVER["SCRIPT_NAME"]) == "users.php" || basename($_SERVER["SCRIPT_NAME"]) == "appointments.php"): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link search-dropdown" href="#" id="searchDropDown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i data-feather="search"></i></a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-lg search-drop-menu"
                            aria-labelledby="searchDropDown">
                            <form method="get">
                                <input class="form-control" name="s" type="search" placeholder="Type something.."
                                    aria-label="Search">
                            </form>
                        </div>
                    </li>
                <?php endif; ?>
                <li class="nav-item dropdown">
                    <a class="nav-link profile-dropdown" href="#" id="profileDropDown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false"><img
                            src="assets/images/avatars/profile-image-1.png" alt=""></a>
                    <div class="dropdown-menu dropdown-menu-end profile-drop-menu" aria-labelledby="profileDropDown">
                        <a class="dropdown-item" href="adminprofile.php"><i data-feather="settings"></i>Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php"><i data-feather="log-out"></i>Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
<div class="page-sidebar">
    <ul class="list-unstyled accordion-menu">
        <li class="<?= basename($_SERVER["SCRIPT_NAME"]) == "index.php" ? 'active-page' : '' ?>">
            <a href="index.php"><i data-feather="home"></i>Dashboard</a>
        </li>
        <li class="<?= basename($_SERVER["SCRIPT_NAME"]) == "products.php" ? 'active-page' : '' ?>">
            <a href="products.php"><i data-feather="layers"></i>Products</a>
        </li>

        <li class="<?= basename($_SERVER["SCRIPT_NAME"]) == "addproduct.php" ? 'active-page' : '' ?>">
            <a href="addproduct.php"><i data-feather="plus"></i>Add Product</a>
        </li>
        <li class="<?= basename($_SERVER["SCRIPT_NAME"]) == "product-category.php" ? 'active-page' : '' ?>">
            <a href="product-category.php"><i data-feather="layers"></i>Category</a>
        </li>
        <li class="<?= basename($_SERVER["SCRIPT_NAME"]) == "blogs.php" ? 'active-page' : '' ?>">
            <a href="blogs.php"><i data-feather="image"></i>Blogs</a>
        </li>
        <li class="<?= basename($_SERVER["SCRIPT_NAME"]) == "orders.php" ? 'active-page' : '' ?>">
            <a href="orders.php"><i data-feather="shopping-cart"></i>Orders</a>
        </li>
        <li class="<?= basename($_SERVER["SCRIPT_NAME"]) == "users.php" ? 'active-page' : '' ?>">
            <a href="users.php"><i data-feather="user"></i>Users</a>
        </li>
        <li class="<?= basename($_SERVER["SCRIPT_NAME"]) == "adminprofile.php" ? 'active-page' : '' ?>">
            <a href="adminprofile.php"><i data-feather="settings"></i>Profile</a>
        </li>
        <li class="">
            <a href="logout.php"><i data-feather="log-out"></i>Logout</a>
        </li>

    </ul>
</div>