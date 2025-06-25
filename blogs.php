<?php
include_once("functions.php");
session_start();
require "vendor/autoload.php";

// Get blog posts (assuming you have a blog table, otherwise we'll use products for demo)
$getBlogPosts = mysqli_query($conn, "SELECT * FROM `blogs` ORDER BY `created_at` DESC LIMIT 12");
// If no blog table exists, you can use products table for demo
// $getBlogPosts = mysqli_query($conn, "SELECT * FROM `products` ORDER BY `id` DESC LIMIT 12");

if (isset($_GET["s"])) {
    $s = mysqli_real_escape_string($conn, $_GET["s"]);
    $getBlogPosts = mysqli_query($conn, "SELECT * FROM `blogs` WHERE `title` LIKE '%$s%' OR `content` LIKE '%$s%' OR `tags` LIKE '%$s%' ORDER BY `created_at` DESC");
}

// Get featured post
$getFeaturedPost = mysqli_query($conn, "SELECT * FROM `blogs` WHERE `featured` = 1 ORDER BY `created_at` DESC LIMIT 1");
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
    <title>Oosa Herbal Care || Blog - Natural Health & Wellness Tips</title>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="Discover natural health tips, herbal remedies, and wellness advice from Oosa Herbal Care experts. Stay updated with the latest in natural healthcare.">
    <meta name="keywords" content="herbal care, natural health, wellness blog, herbal remedies, natural medicine">
    <link rel="shortcut icon" href="assets/images/fav.png" type="image/x-icon">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet">

    <!-- all css -->
    <style>
        :root {
            --primary-color: #2e7d32;
            --secondary-color: #2e7d32;
            --accent-color: #4caf50;
            --light-green: #e8f5e8;
            --text-muted: #6c757d;

            --btn-primary-border-radius: 0.5rem;
            --btn-primary-color: #fff;
            --btn-primary-background-color: #2e7d32;
            --btn-primary-border-color: #2e7d32;
            --btn-primary-hover-color: #fff;
            --btn-primary-background-hover-color: #001a3d;
            --btn-primary-border-hover-color: #001a3d;
            --btn-primary-font-weight: 500;

            --btn-secondary-border-radius: 0.5rem;
            --btn-secondary-color: #2e7d32;
            --btn-secondary-background-color: transparent;
            --btn-secondary-border-color: #2e7d32;
            --btn-secondary-hover-color: #fff;
            --btn-secondary-background-hover-color: #2e7d32;
            --btn-secondary-border-hover-color: #2e7d32;
            --btn-secondary-font-weight: 500;

            --heading-color: #000;
            --heading-font-family: 'Poppins', sans-serif;
            --heading-font-weight: 700;

            --body-color: #333;
            --body-background-color: #fff;
            --body-font-family: 'Poppins', sans-serif;
            --body-font-size: 14px;
            --body-font-weight: 400;
        }

        .blog-hero {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 80px 0 60px;
            color: white;
        }

        .blog-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .blog-card-img {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .blog-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .blog-card:hover .blog-card-img img {
            transform: scale(1.05);
        }

        .blog-meta {
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .blog-category {
            background: var(--light-green);
            color: var(--secondary-color);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            text-decoration: none;
        }

        .featured-post {
            background: linear-gradient(rgba(0, 35, 77, 0.9), rgba(46, 125, 50, 0.9));
            background-size: cover;
            background-position: center;
            color: white;
            border-radius: 15px;
            padding: 60px 40px;
            margin-bottom: 60px;
        }

        .search-box {
            max-width: 500px;
            margin: 0 auto;
        }

        .blog-stats {
            background: var(--light-green);
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--secondary-color);
        }

        .read-more-btn {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
        }

        .read-more-btn:hover {
            color: var(--secondary-color);
            padding-left: 10px;
        }

        .read-more-btn::after {
            content: '→';
            margin-left: 5px;
            transition: margin-left 0.3s ease;
        }

        .read-more-btn:hover::after {
            margin-left: 10px;
        }

        .pagination .page-link {
            border-radius: 8px;
            margin: 0 2px;
            border: 1px solid #dee2e6;
            color: var(--primary-color);
        }

        .pagination .page-link:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .newsletter-section {
            background: var(--light-green);
            border-radius: 15px;
            padding: 3rem 2rem;
            text-align: center;
        }

        .sidebar-widget {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .widget-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--secondary-color);
        }

        .recent-post-item {
            display: flex;
            gap: 1rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e9ecef;
        }

        .recent-post-item:last-child {
            border-bottom: none;
        }

        .recent-post-img {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
        }

        .tag-cloud .badge {
            margin: 0.25rem;
            padding: 0.5rem 0.75rem;
            background: var(--light-green);
            color: var(--secondary-color);
            text-decoration: none;
            border-radius: 20px;
            font-weight: normal;
            transition: all 0.3s ease;
        }

        .tag-cloud .badge:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .blog-hero {
                padding: 40px 0 30px;
            }

            .featured-post {
                padding: 40px 20px;
                margin-bottom: 40px;
            }

            /* .blog-card-img {
                height: 180px;
            } */
        }
    </style>

    <link rel="stylesheet" href="assets/css/vendor.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/wizard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>

<body>
    <div class="body-wrapper">
        <!-- include header.php -->
        <?php include("components/header.php"); ?>
        <!-- include header.php end -->

        <!-- Blog Hero Section -->
        <section class="blog-hero">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="display-4 fw-bold mb-3 text-light">Natural Health & Wellness Blog</h1>
                        <p class="lead mb-4">Discover the power of nature with expert tips, herbal remedies, and
                            wellness advice from Oosa Herbal Care</p>

                        <!-- Search Box -->
                        <form method="GET" class="search-box">
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control border-0 shadow-sm"
                                    placeholder="Search for health tips, remedies..." name="s"
                                    value="<?= isset($_GET['s']) ? htmlspecialchars($_GET['s']) : ''; ?>">
                                <button class="btn btn-light" type="submit">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Post Section -->
        <?php if (mysqli_num_rows($getFeaturedPost) > 0):
            $featured = mysqli_fetch_assoc($getFeaturedPost); ?>
            <section class="py-5">
                <div class="container">
                    <div class="featured-post position-relative" data-aos="fade-up">
                        <img src="uploads/blog/<?= $featured['image'] ?>" alt=""
                            class="w-100 h-100 position-absolute top-0 start-0 "
                            style="z-index: -3; opacity: 0.4; object-fit: cover; border-radius: 15px;">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <span class="blog-category mb-3 d-inline-block">Featured Post</span>
                                <h2 class="display-5 fw-bold mb-3"><?= htmlspecialchars($featured['title']); ?></h2>
                                <p class="lead mb-4"><?= substr(strip_tags($featured['content']), 0, 200) . '...'; ?></p>
                                <div class="d-flex align-items-center gap-3 mb-4">
                                    <span><i
                                            class="fas fa-calendar me-2"></i><?= date('M d, Y', strtotime($featured['created_at'])); ?></span>
                                    <span><i class="fas fa-user me-2"></i>By Admin</span>
                                    <span><i class="fas fa-clock me-2"></i>5 min read</span>
                                </div>
                                <a href="blog-single.php?id=<?= $featured['id']; ?>" class="btn btn-light btn-lg">Read Full
                                    Article</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Blog Stats Section -->
        <section class="py-4 bg-light">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-3 col-6">
                        <div class="blog-stats">
                            <div class="stats-number">150+</div>
                            <div class="text-muted">Health Articles</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="blog-stats">
                            <div class="stats-number">50K+</div>
                            <div class="text-muted">Happy Readers</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="blog-stats">
                            <div class="stats-number">25+</div>
                            <div class="text-muted">Health Categories</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="blog-stats">
                            <div class="stats-number">10+</div>
                            <div class="text-muted">Expert Writers</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Blog Content -->
        <main class="py-5">
            <div class="container">
                <div class="row g-5">
                    <!-- Blog Posts -->
                    <div class="col-12">
                        <?php if (isset($_GET['s']) && !empty($_GET['s'])): ?>
                            <div class="mb-4">
                                <h3>Search Results for: "<?= htmlspecialchars($_GET['s']); ?>"</h3>
                                <p class="text-muted">Found <?= mysqli_num_rows($getBlogPosts); ?> articles</p>
                            </div>
                        <?php endif; ?>

                        <div class="row g-4">
                            <?php
                            if (mysqli_num_rows($getBlogPosts) > 0):
                                $records_per_page = 12;
                                // instantiate the pagination object
                                $posts = mysqli_fetch_all($getBlogPosts, MYSQLI_ASSOC);
                                $pagination = new Zebra_Pagination();

                                // the number of total records is the number of records in the array
                                $pagination->records(count($posts));

                                // records per page
                                $pagination->records_per_page($records_per_page);

                                $posts = array_slice($posts, ($pagination->get_page() - 1) * $records_per_page, $records_per_page);
                                foreach ($posts as $post):
                                    // Sample categories for demo
                                    ?>
                                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                                        <article class="card blog-card h-100">
                                            <div class="blog-card-img">
                                                <img src="<?= !empty($post['image']) ? 'uploads/blog/' . $post['image'] : 'assets/images/blog-placeholder.jpg'; ?>"
                                                    alt="<?= htmlspecialchars($post['title']); ?>" loading="lazy">
                                                <!-- <div class="position-absolute top-0 start-0 m-3">
                                                    <span class="blog-category"><?= $category; ?></span>
                                                </div> -->
                                            </div>
                                            <div class="card-body d-flex flex-column">
                                                <div class="blog-meta mb-2">
                                                    <span class="me-3"><i
                                                            class="fas fa-calendar me-1"></i><?= date('M d, Y', strtotime($post['created_at'] ?? 'now')); ?></span>
                                                    <!-- <span><i class="fas fa-clock me-1"></i>5 min read</span> -->
                                                </div>
                                                <h5 class="card-title mb-3">
                                                    <a href="blog-single.php?id=<?= $post['id']; ?>"
                                                        class="text-decoration-none text-dark">
                                                        <?= htmlspecialchars($post['title']); ?>
                                                    </a>
                                                </h5>
                                                <p class="card-text text-muted mb-3 flex-grow-1">
                                                    <?= substr(strip_tags($post['content']), 0, 120) . '...'; ?>
                                                </p>
                                                <div class="mt-auto">
                                                    <a href="blog-single.php?id=<?= $post['id']; ?>" class="read-more-btn">Read
                                                        More</a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <?php
                                endforeach;
                                $pagination->render();
                            else:
                                ?>
                                <div class="col-12">
                                    <div class="text-center py-5">
                                        <div class="mb-4">
                                            <i class="fas fa-search fa-3x text-muted"></i>
                                        </div>
                                        <h4 class="text-muted">No articles found</h4>
                                        <p class="text-muted mb-4">
                                            <?= isset($_GET['s']) ? 'Try searching with different keywords.' : 'Check back later for new health articles and wellness tips.'; ?>
                                        </p>
                                        <?php if (isset($_GET['s'])): ?>
                                            <a href="blog.php" class="btn btn-primary">View All Articles</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Pagination -->

                    </div>

                    <!-- Sidebar -->

                </div>
            </div>
        </main>

        <!-- include footer -->
        <?php include("components/footer.php"); ?>
        <!-- include footer end -->

        <!-- all js -->
        <script src="assets/js/vendor.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/wizard.js"></script>

        <!-- AOS Animation -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script>
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });
        </script>
    </div>
</body>

</html>