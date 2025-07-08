<?php
if (isset($_SESSION["user"])) {
    $userid = $_SESSION["user"]["userid"];
    $getUser = mysqli_query($conn, "SELECT * FROM `users` WHERE `userid`='$userid'");
    if (mysqli_num_rows($getUser) > 0) {
        $userDetail = mysqli_fetch_assoc($getUser);
    }
}
// var_dump($userDetail);
?>

<!-- announcement bar start -->
<div class="announcement-bar bg-4 py-1 py-lg-2">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-3 d-lg-block d-none">
                <div class="announcement-call-wrapper">
                    <div class="announcement-call">
                        <a class="announcement-text text-white" href="tel:+2347060684352">Call: +234 706 0684 352</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 d-lg-block d-none">
                <div class="announcement-meta-wrapper d-flex align-items-center justify-content-end">
                    <div class="announcement-meta d-flex align-items-center">
                        <?php if (!isset($_SESSION["user"])): ?>
                            <a class="announcement-login announcement-text text-white" href="login.php">
                                <svg class="icon icon-user" width="10" height="11" viewBox="0 0 10 11" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M5 0C3.07227 0 1.5 1.57227 1.5 3.5C1.5 4.70508 2.11523 5.77539 3.04688 6.40625C1.26367 7.17188 0 8.94141 0 11H1C1 8.78516 2.78516 7 5 7C7.21484 7 9 8.78516 9 11H10C10 8.94141 8.73633 7.17188 6.95312 6.40625C7.88477 5.77539 8.5 4.70508 8.5 3.5C8.5 1.57227 6.92773 0 5 0ZM5 1C6.38672 1 7.5 2.11328 7.5 3.5C7.5 4.88672 6.38672 6 5 6C3.61328 6 2.5 4.88672 2.5 3.5C2.5 2.11328 3.61328 1 5 1Z"
                                        fill="#fff" />
                                </svg>
                                <span>Signin / Signup</span>
                            </a>

                        <?php else: ?>
                            <div class="btn-group ms-2">
                                <button class="btn btn-link text-light text-decoration-none dropdown-toggle" type="button"
                                    id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?= isset($userDetail) ? $userDetail["username"] : "User" ?>
                                </button>
                                <div class="dropdown-menu dropdown-menu-start" aria-labelledby="triggerId">
                                    <a class="dropdown-item" href="orders.php">Orders</a>
                                    <a class="dropdown-item" href="profile.php">Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php">Logout</a>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- announcement bar end -->

<!-- header start -->
<header class="sticky-header border-btm-black header-1">
    <div class="header-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-4">
                    <div class="header-logo">
                        <a href="./" class="logo-main ">
                            <img src="assets/images/logo2.png" alt="" style="height: 45px; border-radius: 8px;">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-block d-none">
                    <nav class="site-navigation">
                        <ul class="main-menu list-unstyled justify-content-center">
                            <li
                                class="menu-list-item nav-item <?= basename($_SERVER["SCRIPT_NAME"]) == "index.php" ? "active" : ""; ?> ">
                                <div class="mega-menu-header">
                                    <a class="nav-link text-nowrap" href="index.php"> Home </a>
                                </div>
                            </li>

                            <li
                                class="menu-list-item nav-item <?= basename($_SERVER["SCRIPT_NAME"]) == "shop.php" ? "active" : ""; ?>">
                                <div class="mega-menu-header">
                                    <a class="nav-link text-nowrap" href="shop.php">
                                        Shop
                                    </a>
                                </div>
                            </li>
                            <li
                                class="menu-list-item nav-item <?= basename($_SERVER["SCRIPT_NAME"]) == "blogs.php" ? "active" : ""; ?>">
                                <div class="mega-menu-header">
                                    <a class="nav-link text-nowrap" href="blogs.php">
                                        Blog
                                    </a>
                                </div>
                            </li>

                            <li
                                class="menu-list-item nav-item <?= basename($_SERVER["SCRIPT_NAME"]) == "contact.php" ? "active" : ""; ?>">
                                <a class="nav-link text-nowrap" href="contact.php">Contact Us</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-8 col-8">
                    <div class="header-action d-flex align-items-center justify-content-end">
                        <!-- <?php //if (basename($_SERVER["SCRIPT_NAME"]) == "shop.php"): ?> -->
                        <a class="header-action-item header-search" href="javascript:void(0)">
                            <svg class="icon icon-search" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.75 0.250183C11.8838 0.250183 15.25 3.61639 15.25 7.75018C15.25 9.54608 14.6201 11.1926 13.5625 12.4846L19.5391 18.4611L18.4609 19.5392L12.4844 13.5627C11.1924 14.6203 9.5459 15.2502 7.75 15.2502C3.61621 15.2502 0.25 11.884 0.25 7.75018C0.25 3.61639 3.61621 0.250183 7.75 0.250183ZM7.75 1.75018C4.42773 1.75018 1.75 4.42792 1.75 7.75018C1.75 11.0724 4.42773 13.7502 7.75 13.7502C11.0723 13.7502 13.75 11.0724 13.75 7.75018C13.75 4.42792 11.0723 1.75018 7.75 1.75018Z"
                                    fill="black" />
                            </svg>
                        </a>
                        <!-- <?php //endif; ?> -->
                        <a class="header-action-item position-relative header-wishlist ms-4 d-none d-lg-block"
                            href="<?= isset($_SESSION["user"]) ? 'wishlist.php' : 'login.php'; ?>">
                            <?php
                            if (isset($_SESSION["user"])):
                                $getWishList = mysqli_query($conn, "SELECT * FROM `wish` WHERE `userid` = '$userid'");
                                ?>
                                <small class="position-absolute text-danger fw-bold "
                                    style="top: -5px; right: -5px;"><?= $getWishList->num_rows ?></small>
                            <?php endif; ?>
                            <svg class="icon icon-wishlist" width="26" height="22" viewBox="0 0 26 22" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                    fill="black" />
                            </svg>
                        </a>
                        <a class="header-action-item position-relative header-cart ms-4"
                            href="<?= isset($_SESSION["user"]) ? 'cart.php' : 'login.php'; ?>">
                            <?php
                            if (isset($_SESSION["user"])):
                                $getCartInfo = mysqli_query($conn, "SELECT * FROM `cart` WHERE `userid` = '$userid'");
                                ?>
                                <small class="position-absolute text-danger fw-bold "
                                    style="top: -5px; right: -5px;"><?= $getCartInfo->num_rows ?></small>
                            <?php endif; ?>
                            <svg class="icon icon-cart" width="24" height="26" viewBox="0 0 24 26" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 0.000183105C9.25391 0.000183105 7 2.25409 7 5.00018V6.00018H2.0625L2 6.93768L1 24.9377L0.9375 26.0002H23.0625L23 24.9377L22 6.93768L21.9375 6.00018H17V5.00018C17 2.25409 14.7461 0.000183105 12 0.000183105ZM12 2.00018C13.6562 2.00018 15 3.34393 15 5.00018V6.00018H9V5.00018C9 3.34393 10.3438 2.00018 12 2.00018ZM3.9375 8.00018H7V11.0002H9V8.00018H15V11.0002H17V8.00018H20.0625L20.9375 24.0002H3.0625L3.9375 8.00018Z"
                                    fill="black" />
                            </svg>
                        </a>
                        <a class="header-action-item header-hamburger ms-4 d-lg-none" href="#drawer-menu"
                            data-bs-toggle="offcanvas">
                            <svg class="icon icon-hamburger" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <line x1="3" y1="18" x2="21" y2="18"></line>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- <?php //if (basename($_SERVER["SCRIPT_NAME"]) == "shop.php"): ?> -->
        <div class="search-wrapper">
            <div class="container">
                <form method="GET" class="search-form d-flex align-items-center" action="shop.php">
                    <button type="submit" class="search-submit bg-transparent pl-0 text-start">
                        <svg class="icon icon-search" width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.75 0.250183C11.8838 0.250183 15.25 3.61639 15.25 7.75018C15.25 9.54608 14.6201 11.1926 13.5625 12.4846L19.5391 18.4611L18.4609 19.5392L12.4844 13.5627C11.1924 14.6203 9.5459 15.2502 7.75 15.2502C3.61621 15.2502 0.25 11.884 0.25 7.75018C0.25 3.61639 3.61621 0.250183 7.75 0.250183ZM7.75 1.75018C4.42773 1.75018 1.75 4.42792 1.75 7.75018C1.75 11.0724 4.42773 13.7502 7.75 13.7502C11.0723 13.7502 13.75 11.0724 13.75 7.75018C13.75 4.42792 11.0723 1.75018 7.75 1.75018Z"
                                fill="black" />
                        </svg>
                    </button>
                    <div class="search-input mr-4">
                        <input type="text" name="s" placeholder="Search your products..." autocomplete="off" />
                    </div>
                    <div class="search-close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-close">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </div>
                </form>
            </div>
        </div>
        <!-- <?php //endif; ?> -->
    </div>
</header>
<!-- header end -->