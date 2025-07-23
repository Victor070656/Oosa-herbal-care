<?php
include_once("functions.php");
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <!-- /Added by HTTrack -->
  <title>Oosa Herbal Ventures</title>
  <!-- meta tags -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords"
    content="Oosa, oosa herbal, oosa herbal ventures, herbal remedies, suppliments, herbal, herbal product" />
  <meta name="description"
    content="OOSA Herbal Ventures specializes in the production and distribution of Premium herbal medicines and natural health solutions tailored to meet the diverse wellness needs of our clients. With over 30 years of consistent service, we have built a reputation for excellence, trust, and effectiveness in the field of traditional herbal care." />
  <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon" />
  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com/" />
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap"
    rel="stylesheet" />

  <!-- all css -->
  <link rel="stylesheet" href="assets/css/vendor.css" />
  <link rel="stylesheet" href="assets/css/style.css" />


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
      --heading-font-family: "Poppins", sans-serif !important;
      --heading-font-weight: 700;

      --title-color: #000;
      --title-font-family: "Poppins", sans-serif !important;
      --title-font-weight: 400;

      --body-color: #000;
      --body-background-color: #fff;
      --body-font-family: "Poppins", sans-serif !important;
      --body-font-size: 14px;
      --body-font-weight: 400;

      --section-heading-color: #000;
      --section-heading-font-family: "Poppins", sans-serif !important;
      --section-heading-font-size: 48px;
      --section-heading-font-weight: 600;

      --section-subheading-color: #000;
      --section-subheading-font-family: "Poppins", sans-serif !important;
      --section-subheading-font-size: 16px;
      --section-subheading-font-weight: 400;
    }

    body {
      font-family: "Poppins", sans-serif !important;
    }

    .banner-bg {
      background-image: url("assets/images/banner/bg.png");
      background-repeat: no-repeat;
      background-size: cover;
    }

    .client-experiences {
      background-color: #e8f4f8;
      padding: 60px 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .section-title {
      color: #2c7a7b;
      font-size: 2.5rem;
      font-weight: 300;
      text-align: center;
      margin-bottom: 10px;
    }

    .section-subtitle {
      color: #666;
      text-align: center;
      margin-bottom: 50px;
      font-size: 1rem;
    }

    .treatment-gallery {
      margin-bottom: 50px;
    }

    .treatment-item {
      text-align: center;
      margin-bottom: 30px;
    }

    .treatment-image {
      width: 100%;
      height: 120px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 10px;
      background: linear-gradient(45deg, #d4a574, #c9956b);
    }

    .treatment-label {
      color: #2c7a7b;
      font-size: 0.9rem;
      font-weight: 500;
    }

    .testimonial-card {
      background: white;
      border: 2px solid #b8d4d6;
      border-radius: 10px;
      padding: 25px;
      margin-bottom: 20px;
      min-height: 200px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .quote-mark {
      color: #2c7a7b;
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .testimonial-text {
      color: #666;
      font-size: 0.95rem;
      line-height: 1.6;
      margin-bottom: 15px;
      flex-grow: 1;
    }

    .client-name {
      color: #2c7a7b;
      font-size: 0.9rem;
      font-weight: 600;
      text-align: right;
    }

    .view-more {
      text-align: center;
      margin-top: 30px;
    }

    .view-more a {
      color: #2c7a7b;
      text-decoration: none;
      font-size: 0.9rem;
    }

    /* hero */
    .hero-section {
      min-height: 100vh;
      background: linear-gradient(135deg, #f8fdf8 0%, #e8f5e8 100%);
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
    }

    .hero-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="leaves" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M10,5 Q15,10 10,15 Q5,10 10,5" fill="none" stroke="%23c8e6c9" stroke-width="0.5" opacity="0.3"/></pattern></defs><rect width="100" height="100" fill="url(%23leaves)"/></svg>') repeat;
      opacity: 0.1;
      animation: float 20s ease-in-out infinite;
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0px) rotate(0deg);
      }

      50% {
        transform: translateY(-10px) rotate(1deg);
      }
    }

    .hero-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
      position: relative;
      z-index: 2;
    }

    .hero-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 60px;
      align-items: center;
    }

    .hero-text {
      animation: slideInLeft 1s ease-out;
    }

    .hero-badge {
      display: inline-block;
      background: linear-gradient(45deg, #4caf50, #66bb6a);
      color: white;
      padding: 8px 20px;
      border-radius: 25px;
      font-size: 14px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-bottom: 20px;
      box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
    }

    .hero-title {
      font-size: clamp(2.0rem, 4vw, 3.5rem);
      font-weight: 700;
      color: #2e7d32;
      line-height: 1.2;
      margin-bottom: 20px;
    }

    .hero-title .highlight {
      background: linear-gradient(45deg, #4caf50, #81c784);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .hero-subtitle {
      font-size: 1.2rem;
      color: #558b2f;
      margin-bottom: 30px;
      line-height: 1.6;
    }

    .hero-description {
      font-size: 1rem;
      color: #666;
      margin-bottom: 40px;
      line-height: 1.7;
    }

    .hero-buttons {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
    }

    .action-btn {
      padding: 15px 30px;
      border: none;
      border-radius: 50px;
      font-size: 16px;
      font-weight: 600;
      text-decoration: none;
      display: inline-block;
      transition: all 0.3s ease;
      cursor: pointer;
      position: relative;
      overflow: hidden;
    }

    .action-btn-primary {
      background: linear-gradient(45deg, #4caf50, #66bb6a);
      color: white;
      box-shadow: 0 8px 25px rgba(76, 175, 80, 0.3);
    }

    .action-btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 35px rgba(76, 175, 80, 0.4);
    }

    .action-btn-secondary {
      background: transparent;
      color: #4caf50;
      border: 2px solid #4caf50;
    }

    .action-btn-secondary:hover {
      background: #4caf50;
      color: white;
      transform: translateY(-2px);
    }

    .hero-image {
      position: relative;
      animation: slideInRight 1s ease-out;
    }

    .hero-image-container {
      position: relative;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    }

    .hero-image img {
      width: 100%;
      height: auto;
      display: block;
      border-radius: 20px;
    }

    .floating-elements {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      pointer-events: none;
    }

    .floating-element {
      position: absolute;
      background: linear-gradient(45deg, #4caf50, #81c784);
      border-radius: 50%;
      opacity: 0.1;
      animation: floatUp 6s ease-in-out infinite;
    }

    .floating-element:nth-child(1) {
      width: 80px;
      height: 80px;
      top: 20%;
      left: 10%;
      animation-delay: 0s;
    }

    .floating-element:nth-child(2) {
      width: 60px;
      height: 60px;
      top: 60%;
      right: 15%;
      animation-delay: 2s;
    }

    .floating-element:nth-child(3) {
      width: 100px;
      height: 100px;
      bottom: 20%;
      left: 20%;
      animation-delay: 4s;
    }

    @keyframes floatUp {

      0%,
      100% {
        transform: translateY(0px) scale(1);
        opacity: 0.1;
      }

      50% {
        transform: translateY(-20px) scale(1.1);
        opacity: 0.15;
      }
    }

    @keyframes slideInLeft {
      from {
        opacity: 0;
        transform: translateX(-50px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes slideInRight {
      from {
        opacity: 0;
        transform: translateX(50px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .stats {
      display: flex;
      gap: 30px;
      margin-top: 40px;
    }

    .stat-item {
      text-align: center;
    }

    .stat-number {
      font-size: 2rem;
      font-weight: 700;
      color: #4caf50;
      display: block;
    }

    .stat-label {
      font-size: 0.9rem;
      color: #666;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .hero-content {
        grid-template-columns: 1fr;
        gap: 40px;
        text-align: center;
      }

      .hero-buttons {
        justify-content: center;
      }

      .stats {
        justify-content: center;
      }

      .action-btn {
        padding: 12px 25px;
        font-size: 14px;
      }
    }

    @media (max-width: 480px) {
      .hero-buttons {
        flex-direction: column;
        align-items: center;
      }

      .action-btn {
        width: 100%;
        max-width: 280px;
      }

      .stats {
        flex-direction: column;
        gap: 20px;
      }
    }

    .product-card {
      transition: all 0.3s ease;
      border-radius: 12px !important;
    }

    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
    }

    .product-image {
      transition: transform 0.3s ease;
    }

    .product-card:hover .product-image {
      transform: scale(1.05);
    }

    .product-actions {
      transition: opacity 0.3s ease;
    }

    .product-card:hover .product-actions {
      opacity: 1 !important;
    }

    .transition-transform {
      transition: transform 0.3s ease;
    }

    .transition-opacity {
      transition: opacity 0.3s ease;
    }

    .stretched-link::after {
      z-index: 1;
    }

    .product-actions .btn {
      position: relative;
      z-index: 2;
      backdrop-filter: blur(10px);
      background-color: rgba(255, 255, 255, 0.9) !important;
      border: 1px solid rgba(0, 0, 0, 0.1) !important;
    }

    .product-actions .btn-dark {
      background-color: rgba(0, 0, 0, 0.8) !important;
      color: white !important;
    }

    .product-actions .btn:hover {
      transform: scale(1.1);
    }

    /* Mobile responsiveness */
    @media (max-width: 576px) {
      .product-actions {
        opacity: 1 !important;
        position: static !important;
        transform: none !important;
        margin-top: 1rem;
      }

      .product-card:hover {
        transform: none;
      }
    }

    .init-overlay {
      display: none;
      z-index: 1000;
      background-color: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(10px);
      transition: .8s ease;
    }

    /* testimonial */
    .testimonial-card {
      background: #fff;
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
      max-width: 500px;
      margin: auto;
    }

    .testimonial-card p {
      font-style: italic;
      margin-bottom: 1rem;
    }

    .testimonial-card h4 {
      font-weight: 600;
      margin-top: 0.5rem;
      color: #333;
    }

    .swiper {
      width: 100%;
      padding: 3rem 0;
    }

    .swiper-button-next,
    .swiper-button-prev {
      color: #000;
    }
  </style>
  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body>
  <div class="body-wrapper">

    <!-- overlay -->
    <div class="w-100 vh-100 init-overlay position-fixed ">
      <div class="w-100 h-100 d-flex align-items-center justify-content-center">

        <div class="card bg-light col-md-6 text-center p-5" style="border-radius: 10px">
          <h3>Welcome to Oosa Herbal Ventures</h3>
          <h4 class="mb-0">🌿🍇🍏</h4>
        </div>
      </div>
    </div>
    <!-- overlay end -->
    <!-- include header.php -->
    <?php
    include("components/header.php");
    ?>
    <!-- include header.php end -->

    <main id="MainContent" class="content-for-layout ">



      <!-- slideshow start -->
      <div id="carouselId" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner" role="listbox">
          <?php
          $getBanners = mysqli_query($conn, "SELECT * FROM `banners`");
          if (mysqli_num_rows($getBanners) > 0):
            $banners = mysqli_fetch_all($getBanners, MYSQLI_ASSOC);
            foreach ($banners as $i => $banner):
              ?>

              <div class="carousel-item <?= $i == 0 ? "active" : "" ?>">
                <section class="hero-section">
                  <div class="floating-elements">
                    <div class="floating-element"></div>
                    <div class="floating-element"></div>
                    <div class="floating-element"></div>
                  </div>

                  <div class="hero-container">
                    <div class="row h-100 py-3">
                      <div class="hero-text col-md-5 mb-3 mb-md-1">
                        <div class="hero-badge">Natural • Pure • Effective</div>
                        <h1 class="hero-title">
                          <?= $banner["heading"] ?>
                        </h1>
                        <p class="hero-subtitle">
                          <?= $banner["subtitle"] ?>
                        </p>

                        <div class="hero-buttons">
                          <a href="shop.php" class="action-btn action-btn-primary">Shop Remedies</a>
                          <a href="contact.php" class="action-btn action-btn-secondary">Free Consultation</a>
                        </div>
                      </div>

                      <div class="hero-image col-md-7 mb-3 mb-md-0">
                        <div class="hero-image-container">
                          <img src="uploads/banner/<?= $banner['image'] ?>" style="aspect-ratio: 4/3; object-fit: ;"
                            alt="Natural herbal remedies and wellness products" />
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>
              <?php
            endforeach;
          endif;
          ?>


        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <!-- end slideshow -->

      <!-- about us -->
      <section class="py-5" style="background-color: #f3fff4ff">
        <div class="container py-3">
          <div class="row align-items-center">
            <div class="col-md-6 mb-3 mb-md-1">
              <img src="assets/images/herb/02.webp" class="shadow" style="border-radius: 15px;" alt="">
            </div>
            <div class="col-md-6">
              <h2 class="display-6 fw-bold text-success mb-3">About Oosa Herbal Ventures</h2>
              <p class="text-muted" style="text-align: justify;">
                About Oosa Herbal Ventures
                At Oosa Herbal Ventures, we're dedicated to herbal healthcare and your general well-being. We produce
                high-quality herbal products designed to address a wide range of health conditions.
                Our expertly formulated products offer natural solutions for issues such as:
                Hormonal imbalances (including irregular or absent menstruation, ovarian cysts, and pelvic inflammatory
                disease).
                Infections (like staphylococcus, chlamydia, candida, yeast infections, and syphilis)
                Reproductive health concerns (including low/no sperm count, low libido, low performance, and
                primary/secondary infertility)
                Enlargements (prostate, heart, and liver).
                Chronic conditions (such as ulcer, stroke, arthritis, rheumatism, joint pain, waist pain, general body
                pains, diabetes, and asthma).
                We are committed to excellence. All our products are crafted by experienced herbalists and undergo
                rigorous quality assurance processes before packaging. You can trust in their safety and efficacy, as
                every Oosa Herbal Ventures product is NAFDAC approved.
              </p>
            </div>
          </div>
        </div>
      </section>
      <!-- about us end -->

      <section class="py-5 bg-white">
        <div class="container">
          <!-- Section Header -->
          <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
              <h2 class="display-5 fw-bold text-success mb-3">Why Choose Oosa Herbal</h2>
              <p class="lead text-muted">
                OOSA Herbal Ventures specializes in the production and distribution of Premium herbal medicines and
                natural health solutions tailored to meet the diverse wellness needs of our clients. With over 30 years
                of consistent service, we have built a reputation for excellence, trust, and effectiveness in the field
                of traditional herbal care
              </p>
            </div>
          </div>

          <!-- Features Grid -->
          <div class="row g-4">
            <!-- Natural & Pure -->
            <div class="col-md-4">
              <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-body text-center p-4">
                  <div class="mb-4">
                    <div
                      class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                      style="width: 80px; height: 80px;">
                      <i class="bi bi-flower2 text-light" style="font-size: 2.5rem;"></i>
                    </div>
                  </div>
                  <h4 class="card-title fw-bold text-dark mb-3">100% Natural & Pure</h4>
                  <p class="card-text text-muted">
                    Our herbal remedies are sourced from organic farms and processed without artificial additives,
                    ensuring you get the purest form of nature's healing power.
                  </p>
                </div>
              </div>
            </div>

            <!-- Scientifically Tested -->
            <div class="col-md-4">
              <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-body text-center p-4">
                  <div class="mb-4">
                    <div
                      class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                      style="width: 80px; height: 80px;">
                      <i class="bi bi-award text-light" style="font-size: 2.5rem;"></i>
                    </div>
                  </div>
                  <h4 class="card-title fw-bold text-dark mb-3">Scientifically Tested</h4>
                  <p class="card-text text-muted">
                    Every product undergoes rigorous quality testing and is backed by research to ensure safety,
                    potency, and effectiveness for your wellness journey.
                  </p>
                </div>
              </div>
            </div>

            <!-- Expert Guidance -->
            <div class="col-md-4">
              <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-body text-center p-4">
                  <div class="mb-4">
                    <div
                      class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                      style="width: 80px; height: 80px;">
                      <i class="bi bi-person-heart text-light" style="font-size: 2.5rem;"></i>
                    </div>
                  </div>
                  <h4 class="card-title fw-bold text-dark mb-3">Expert Guidance</h4>
                  <p class="card-text text-muted">
                    Our team of qualified herbalists and wellness experts are here to guide you in choosing the right
                    remedies for your specific health needs.
                  </p>
                </div>
              </div>
            </div>

          </div>

          <!-- Call to Action -->
          <div class="row justify-content-center mt-5">
            <div class="col-lg-8 text-center ">
              <div class="bg-success bg-opacity-10 p-5" style="border-radius: 15px;">
                <h3 class="fw-bold text-light mb-3">Ready to Start Your Natural Wellness Journey?</h3>
                <p class="text-light mb-4">
                  Whether you're looking for preventive care, natural healing, or holistic support, OOSA Herbal Ventures
                  remains your trusted partner in achieving optimal wellness through nature.
                </p>
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                  <a href="shop.php" class="btn btn-light px-4">
                    <i class="bi bi-cart3 me-2"></i>Shop Now
                  </a>
                  <a href="contact.php" class="btn btn-outline-light px-4">
                    <i class="bi bi-chat-dots me-2"></i>Free Consultation
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- featured collection start -->
      <div class="featured-collection-section mt-100 mb-5 home-section overflow-hidden">
        <div class="container">
          <div class="section-header text-center">
            <p class="section-subheading">WHAT'S NEW</p>
            <h2 class="section-heading">The Latest Drop</h2>
          </div>

          <div class="row g-4 justify-content-center">
            <?php
            $getPopularProducts = mysqli_query($conn, "SELECT p.*, c.category_name FROM `products` as p JOIN `categories` as c ON p.category_id = c.id ORDER BY p.id DESC LIMIT 6");

            if (mysqli_num_rows($getPopularProducts) > 0):
              while ($popular = mysqli_fetch_assoc($getPopularProducts)):
                $discount = 0;
                if ($popular["discount"] > 0) {
                  $discount = $popular["price"] - ($popular["price"] * ($popular["discount"] / 100));
                }
                ?>
                <div class="col-lg-4 col-md-6 col-sm-6" data-aos="fade-up" data-aos-duration="700">
                  <div class="card h-100 shadow-sm border-0 product-card position-relative overflow-hidden">

                    <!-- Discount Badge -->
                    <?php if ($popular["discount"] > 0): ?>
                      <div class="position-absolute m-2" style="z-index: 10;top: 0; left: 0;">
                        <small class="badge bg-danger rounded-pill fw-semibold">
                          -<?= $popular["discount"]; ?>%
                        </small>
                      </div>
                    <?php endif; ?>

                    <!-- Product Image Container -->
                    <div class="position-relative overflow-hidden bg-light">
                      <a href="product.php?pid=<?= $popular["productid"]; ?>" class="text-decoration-none d-block">
                        <img src="uploads/<?= $popular["image"]; ?>" class="card-img-top product-image transition-transform"
                          alt="<?= htmlspecialchars($popular["name"]); ?>"
                          style="aspect-ratio: 4/3; object-fit: cover; height: 250px;" loading="lazy" />
                      </a>

                      <!-- Hover Action Buttons -->
                      <div
                        class="product-actions position-absolute top-50 start-50 translate-middle opacity-0 transition-opacity"
                        style="z-index: 20;">
                        <div class="d-flex gap-2">
                          <a href="addtowish.php?pid=<?= $popular["productid"]; ?>"
                            class="btn btn-outline-dark btn-sm rounded-pill d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px;" title="Add to Wishlist"
                            aria-label="Add <?= htmlspecialchars($popular["name"]); ?> to wishlist">
                            <svg width="18" height="16" viewBox="0 0 26 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M6.96429 0.000183105C3.12305 0.000183105 0 3.10686 0 6.84843C0 8.15388 0.602121 9.28455 1.16071 10.1014C1.71931 10.9181 2.29241 11.4425 2.29241 11.4425L12.3326 21.3439L13 22.0002L13.6674 21.3439L23.7076 11.4425C23.7076 11.4425 26 9.45576 26 6.84843C26 3.10686 22.877 0.000183105 19.0357 0.000183105C15.8474 0.000183105 13.7944 1.88702 13 2.68241C12.2056 1.88702 10.1526 0.000183105 6.96429 0.000183105ZM6.96429 1.82638C9.73912 1.82638 12.3036 4.48008 12.3036 4.48008L13 5.25051L13.6964 4.48008C13.6964 4.48008 16.2609 1.82638 19.0357 1.82638C21.8613 1.82638 24.1429 4.10557 24.1429 6.84843C24.1429 8.25732 22.4018 10.1584 22.4018 10.1584L13 19.4036L3.59821 10.1584C3.59821 10.1584 3.14844 9.73397 2.69866 9.07411C2.24888 8.41426 1.85714 7.55466 1.85714 6.84843C1.85714 4.10557 4.13867 1.82638 6.96429 1.82638Z"
                                fill="currentColor" />
                            </svg>
                          </a>

                          <a href="addtocart.php?pid=<?= $popular["productid"]; ?>"
                            class="btn btn-dark btn-sm rounded-pill d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px;" title="Add to Cart"
                            aria-label="Add <?= htmlspecialchars($popular["name"]); ?> to cart">
                            <svg width="18" height="20" viewBox="0 0 24 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M12 0.000183105C9.25391 0.000183105 7 2.25409 7 5.00018V6.00018H2.0625L2 6.93768L1 24.9377L0.9375 26.0002H23.0625L23 24.9377L22 6.93768L21.9375 6.00018H17V5.00018C17 2.25409 14.7461 0.000183105 12 0.000183105ZM12 2.00018C13.6562 2.00018 15 3.34393 15 5.00018V6.00018H9V5.00018C9 3.34393 10.3438 2.00018 12 2.00018ZM3.9375 8.00018H7V11.0002H9V8.00018H15V11.0002H17V8.00018H20.0625L20.9375 24.0002H3.0625L3.9375 8.00018Z"
                                fill="currentColor" />
                            </svg>
                          </a>
                        </div>
                      </div>
                    </div>

                    <!-- Product Details -->
                    <div class="card-body d-flex flex-column">
                      <h5 class="card-title mb-2 lh-sm">
                        <a href="product.php?pid=<?= $popular["productid"]; ?>"
                          class="text-decoration-none text-dark fw-medium stretched-link"
                          style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                          <?= htmlspecialchars($popular["name"]); ?>
                        </a>
                      </h5>
                      <div class="">

                        <small
                          class="badge bg-success rounded-pill d-inline"><?= htmlspecialchars($popular["category_name"]); ?></small>
                      </div>

                      <!-- Price Section -->
                      <div class="mt-auto">
                        <?php if ($popular["discount"] > 0): ?>
                          <div class="d-flex align-items-center gap-2 flex-wrap">
                            <span class="fs-5 fw-bold text-success mb-0">
                              ₦<?= number_format($discount, 0); ?>
                            </span>
                            <span class="text-muted text-decoration-line-through fs-6">
                              ₦<?= number_format($popular["price"], 0); ?>
                            </span>
                          </div>
                          <small class="text-success fw-medium">
                            You save ₦<?= number_format($popular["price"] - $discount, 0); ?>
                          </small>
                        <?php else: ?>
                          <span class="fs-5 fw-bold text-dark mb-0">
                            ₦<?= number_format($popular["price"], 0); ?>
                          </span>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
              endwhile;
            else:
              ?>
              <div class="col-12">
                <div class="text-center py-5">
                  <div class="mb-3">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                      class="text-muted">
                      <path
                        d="M7 4V2C7 1.45 7.45 1 8 1H16C16.55 1 17 1.45 17 2V4H20C20.55 4 21 4.45 21 5S20.55 6 20 6H19V19C19 20.1 18.1 21 17 21H7C5.9 21 5 20.1 5 19V6H4C3.45 6 3 5.55 3 5S3.45 4 4 4H7ZM9 3V4H15V3H9ZM7 6V19H17V6H7Z"
                        fill="currentColor" />
                    </svg>
                  </div>
                  <h5 class="text-muted">No products found</h5>
                  <p class="text-muted mb-0">Check back later for new products.</p>
                </div>
              </div>
              <?php
            endif;
            ?>
          </div>
          <div class="view-all text-center" data-aos="fade-up" data-aos-duration="700">
            <a class="btn btn-success" href="shop.php">VIEW ALL</a>
          </div>
        </div>
      </div>
      <!-- featured collection end -->

      <section class="container py-5">
        <div class="row align-items-center g-5">
          <!-- Image Column -->
          <div class="col-lg-5 mb-4 mb-lg-0">
            <div class="position-relative">
              <img src="assets/images/logo2.png" alt="Natural Herbal Remedies Collection"
                class="img-fluid shadow-lg rounded-4 w-100" style="aspect-ratio: 1/1; object-fit: cover;">

              <!-- Floating Badge -->
              <div class="position-absolute top-0 start-0 translate-middle">
                <div
                  class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                  style="width: 60px; height: 60px;">
                  <i class="bi bi-award-fill fs-4"></i>
                </div>
              </div>

              <!-- Stats Card -->
              <div class="position-absolute bottom-0 end-0 translate-middle-y me-n3">
                <div class="card border-0 shadow-sm bg-white rounded-4 p-3" style="min-width: 120px;">
                  <div class="text-center">
                    <div class="text-success fw-bold fs-4">500+</div>
                    <div class="text-muted small">Natural Remedies</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Column -->
          <div class="col-lg-7">
            <div class="ps-lg-4">
              <!-- Badge -->
              <div class="mb-3">
                <span class="badge bg-success bg-opacity-10 text-light px-3 py-2 rounded-pill fs-6 fw-normal">
                  <i class="bi bi-leaf me-1"></i>
                  Premium Natural Wellness
                </span>
              </div>

              <!-- Main Heading -->
              <h2 class="display-6 fw-bold text-dark mb-4 lh-sm">
                Begin Your Journey to
                <span class="text-success">Natural Wellness</span>
                with Oosa Herbal
              </h2>

              <!-- Description -->
              <p class="text-muted mb-4 lh-base" style="text-align: justify;">
                Our remedies are carefully formulated using pure, natural ingredients, combining ancestral wisdom with
                modern-day knowledge to offer safe, potent, and side-effect-free alternatives to conventional medicine.
                At OOSA Herbal Ventures, we are passionate about restoring health the natural way—through nature’s own
                pharmacy.
                Over the years, we have proudly helped thousands of individuals overcome health challenges related to
                infertility, infections, hormonal imbalance, Bone and Joint Related issues, low libido, malaria,
                typhoid, and more. Our products are ethically sourced, lab-tested, carefully packaged and NAFDAC
                approved to ensure maximum safety and results.
              </p>

              <!-- Key Benefits -->
              <div class="row g-3 mb-4">
                <div class="col-sm-6">
                  <div class="d-flex align-items-center">
                    <div
                      class="bg-success bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center"
                      style="width: 40px; height: 40px; min-width: 40px;">
                      <i class="bi bi-check2 text-light fw-bold"></i>
                    </div>
                    <span class="text-dark fw-medium">Personalized Consultations</span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="d-flex align-items-center">
                    <div
                      class="bg-success bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center"
                      style="width: 40px; height: 40px; min-width: 40px;">
                      <i class="bi bi-check2 text-light fw-bold"></i>
                    </div>
                    <span class="text-dark fw-medium">Certified Herbalists</span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="d-flex align-items-center">
                    <div
                      class="bg-success bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center"
                      style="width: 40px; height: 40px; min-width: 40px;">
                      <i class="bi bi-check2 text-light fw-bold"></i>
                    </div>
                    <span class="text-dark fw-medium">Custom Remedy Plans</span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="d-flex align-items-center">
                    <div
                      class="bg-success bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center"
                      style="width: 40px; height: 40px; min-width: 40px;">
                      <i class="bi bi-check2 text-light fw-bold"></i>
                    </div>
                    <span class="text-dark fw-medium">Natural & Safe Solutions</span>
                  </div>
                </div>
              </div>

              <!-- Call to Action -->
              <div class="d-flex flex-column flex-sm-row gap-3">
                <a href="contact.php" class="btn btn-success px-4 py-3">
                  <i class="bi bi-calendar-heart me-2"></i>
                  Book Free Consultation
                </a>
                <a href="shop.php" class="btn btn-outline-success px-4 py-3">
                  <i class="bi bi-shop me-2"></i>
                  Explore Remedies
                </a>
              </div>

              <!-- Trust Indicators -->
              <!-- <div class="mt-4 pt-3 border-top border-light">
                <div class="row g-3 text-center">
                  <div class="col-4">
                    <div class="text-success fw-bold h5 mb-1">10K+</div>
                    <div class="text-muted small">Happy Customers</div>
                  </div>
                  <div class="col-4">
                    <div class="text-success fw-bold h5 mb-1">15+</div>
                    <div class="text-muted small">Years Experience</div>
                  </div>
                  <div class="col-4">
                    <div class="text-success fw-bold h5 mb-1">100%</div>
                    <div class="text-muted small">Natural Products</div>
                  </div>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </section>



      <!-- trusted badge start -->
      <div class="trusted-section mt-100 overflow-hidden">
        <div class="trusted-section-inner">
          <div class="container">
            <div class="row justify-content-center trusted-row">
              <div class="col-lg-4 col-md-6 col-12">
                <div class="trusted-badge bg-trust-1 rounded">
                  <div class="trusted-icon">
                    <img class="icon-trusted" src="assets/img/trusted/1.png" alt="icon-1" />
                  </div>
                  <div class="trusted-content">
                    <h2 class="heading_18 trusted-heading">
                      International Delivery
                    </h2>
                    <p class="text_16 trusted-subheading trusted-subheading-2">
                      Global delivery available
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-12">
                <div class="trusted-badge bg-trust-2 rounded">
                  <div class="trusted-icon">
                    <img class="icon-trusted" src="assets/img/trusted/2.png" alt="icon-2" />
                  </div>
                  <div class="trusted-content">
                    <h2 class="heading_18 trusted-heading">
                      Customer Support 24/7
                    </h2>
                    <p class="text_16 trusted-subheading trusted-subheading-2">
                      Instant access to support
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-12">
                <div class="trusted-badge bg-trust-3 rounded">
                  <div class="trusted-icon">
                    <img class="icon-trusted" src="assets/img/trusted/3.png" alt="icon-3" />
                  </div>
                  <div class="trusted-content">
                    <h2 class="heading_18 trusted-heading">
                      100% Secure Payment
                    </h2>
                    <p class="text_16 trusted-subheading trusted-subheading-2">
                      We ensure secure payment!
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- trusted badge end -->


      <!-- testimonial -->
      <div class="container">
        <div class="swiper mx-auto testimonial-swiper mt-5">
          <div class="my-3 text-center">
            <h1 class="text-success">Testimonials</h1>
            <p class="">What our customers say about us</p>
          </div>
          <div class="swiper-wrapper">
            <?php
            $getTestimonials = mysqli_query($conn, "SELECT * FROM `testimonials` ORDER BY `id` DESC LIMIT 6");
            if (mysqli_num_rows($getTestimonials) > 0):
              while ($testimonial = mysqli_fetch_assoc($getTestimonials)):
                ?>
                <!-- Slide 1 -->
                <div class="swiper-slide">
                  <div class="testimonial-card">
                    <p>"<?= htmlspecialchars($testimonial['message']); ?>"</p>
                    <div class="">
                      <h6 class="mb-0">- <?= htmlspecialchars($testimonial['name']); ?></h6>
                      <small class="mt-0"><?= htmlspecialchars($testimonial['position']); ?></small>
                    </div>
                  </div>
                </div>
                <?php
              endwhile;
            else:
              ?>
              <div class="swiper-slide">
                <div class="card border-0 shadow-sm h-100">
                  <div class="card-body p-4 p-md-5 text-center">
                    <p>No testimonials available at the moment. Check back later!</p>
                  </div>
                </div>
              </div>
            <?php endif; ?>

          </div>

          <!-- Pagination & Navigation -->
          <div class="swiper-pagination"></div>
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
      </div>




    </main>

    <!-- include footer -->
    <?php
    include("components/footer.php");
    ?>
    <!-- include footer end -->



    <!-- all js -->
    <script>
      // Add smooth scrolling for anchor links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute('href'));
          if (target) {
            target.scrollIntoView({
              behavior: 'smooth'
            });
          }
        });
      });

      // Add hover effects for interactive elements
      document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('mouseenter', function () {
          this.style.transform = 'translateY(-2px)';
        });

        btn.addEventListener('mouseleave', function () {
          this.style.transform = 'translateY(0)';
        });
      });

      // Animate stats on scroll
      const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -100px 0px'
      };

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const statNumbers = entry.target.querySelectorAll('.stat-number');
            statNumbers.forEach(stat => {
              const finalValue = stat.textContent;
              const isPercentage = finalValue.includes('%');
              const isPlus = finalValue.includes('+');
              const numericValue = parseInt(finalValue.replace(/[^\d]/g, ''));

              let current = 0;
              const increment = numericValue / 50;
              const timer = setInterval(() => {
                current += increment;
                if (current >= numericValue) {
                  current = numericValue;
                  clearInterval(timer);
                }
                stat.textContent = Math.floor(current) + (isPercentage ? '%' : '') + (isPlus ? '+' : '');
              }, 30);
            });
          }
        });
      }, observerOptions);

      const statsSection = document.querySelector('.stats');
      if (statsSection) {
        observer.observe(statsSection);
      }

      var overlay = document.querySelector(".init-overlay");
      window.addEventListener("load", function () {
        overlay.style.display = "block";
        setTimeout(function () {
          overlay.style.display = "none";
        }, 1000);
      });

      overlay.addEventListener("click", function () {
        overlay.style.display = "none";
      });
    </script>
    <script src="assets/js/vendor.js"></script>
    <script src="assets/js/main.js"></script>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
      const swiper = new Swiper('.testimonial-swiper', {
        loop: true,
        grabCursor: true,
        spaceBetween: 30,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
      });
    </script>

  </div>
</body>

<!-- Mirrored from spreethemesprevious.github.io/bisum/html/index-shoe.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 May 2024 11:37:07 GMT -->

</html>