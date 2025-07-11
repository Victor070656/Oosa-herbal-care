<?php
include_once("functions.php");
session_start();
require "vendor/autoload.php";

// Get blog post by ID
$blog_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$getBlogPost = mysqli_query($conn, "SELECT * FROM `blogs` WHERE `id` = $blog_id");
$blog = mysqli_fetch_assoc($getBlogPost);

if (!$blog) {
    header("Location: blog.php");
    exit();
}

// Get related posts (same category or recent posts)
$getRelatedPosts = mysqli_query($conn, "SELECT * FROM `blogs` WHERE `id` != $blog_id ORDER BY `created_at` DESC LIMIT 4");

// Get recent posts for sidebar
$getRecentPosts = mysqli_query($conn, "SELECT * FROM `blogs` WHERE `id` != $blog_id ORDER BY `created_at` DESC LIMIT 5");

// Get popular posts (you might want to track views)
$getPopularPosts = mysqli_query($conn, "SELECT * FROM `blogs` WHERE `id` != $blog_id ORDER BY `id` DESC LIMIT 5");

// Update view count
// mysqli_query($conn, "UPDATE `blogs` SET `views` = `views` + 1 WHERE `id` = $blog_id");

// Get blog categories for sidebar
// $getCategories = mysqli_query($conn, "SELECT DISTINCT `category`, COUNT(*) as count FROM `blogs` WHERE `category` IS NOT NULL GROUP BY `category` ORDER BY count DESC");

// Get blog tags (assuming you have a tags field)
$tags = !empty($blog['tags']) ? explode(',', $blog['tags']) : [];
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
    <title><?= htmlspecialchars($blog['title']); ?> - Oosa Herbal Ventures Blog</title>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= htmlspecialchars(substr(strip_tags($blog['content']), 0, 160)); ?>">
    <meta name="keywords" content="<?= htmlspecialchars($blog['tags'] ?? 'herbal care, natural health, wellness'); ?>">
    <meta name="author" content="<?= htmlspecialchars($blog['author'] ?? 'Oosa Herbal Ventures'); ?>">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?= htmlspecialchars($blog['title']); ?>">
    <meta property="og:description" content="<?= htmlspecialchars(substr(strip_tags($blog['content']), 0, 160)); ?>">
    <meta property="og:image" content="uploads/blog/<?= htmlspecialchars($blog['image']); ?>">
    <meta property="og:url" content="<?= "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
    <meta property="og:type" content="article">

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
            padding: 60px 0 40px;
            color: white;
        }

        .breadcrumbs {
            background: none;
            padding: 0;
            margin: 0;
        }

        .breadcrumbs-item+.breadcrumb-item::before {
            content: "›";
            color: rgba(255, 255, 255, 0.7);
        }

        .breadcrumbs-item a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        .breadcrumbs-item.active {
            color: white;
        }

        .blog-content {
            padding: 60px 0;
        }

        .blog-header {
            margin-bottom: 3rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #e9ecef;
        }

        .blog-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .blog-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .blog-category {
            background: var(--light-green);
            color: var(--secondary-color);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            text-decoration: none;
            margin-bottom: 1rem;
            display: inline-block;
        }

        .blog-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--heading-color);
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .blog-featured-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .blog-content-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--body-color);
        }

        .blog-content-text h1,
        .blog-content-text h2,
        .blog-content-text h3,
        .blog-content-text h4,
        .blog-content-text h5,
        .blog-content-text h6 {
            color: var(--heading-color);
            font-weight: 600;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .blog-content-text h2 {
            font-size: 1.8rem;
            border-left: 4px solid var(--primary-color);
            padding-left: 1rem;
        }

        .blog-content-text h3 {
            font-size: 1.5rem;
        }

        .blog-content-text p {
            margin-bottom: 1.5rem;
        }

        .blog-content-text ul,
        .blog-content-text ol {
            margin-bottom: 1.5rem;
            padding-left: 2rem;
        }

        .blog-content-text li {
            margin-bottom: 0.5rem;
        }

        .blog-content-text blockquote {
            background: var(--light-green);
            border-left: 4px solid var(--primary-color);
            padding: 1.5rem;
            margin: 2rem 0;
            border-radius: 8px;
            font-style: italic;
            font-size: 1.1rem;
        }

        .blog-footer {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid #e9ecef;
        }

        .blog-tags {
            margin-bottom: 2rem;
        }

        .blog-tags .tag {
            background: var(--light-green);
            color: var(--secondary-color);
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            text-decoration: none;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .blog-tags .tag:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
        }

        .blog-share {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .share-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: white;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .share-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .share-btn.facebook {
            background: #3b5998;
        }

        .share-btn.twitter {
            background: #1da1f2;
        }

        .share-btn.linkedin {
            background: #0077b5;
        }

        .share-btn.whatsapp {
            background: #25d366;
        }

        .author-box {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 2rem;
            margin: 3rem 0;
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .author-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
        }

        .author-info h4 {
            margin-bottom: 0.5rem;
            color: var(--heading-color);
        }

        .author-bio {
            color: var(--text-muted);
            line-height: 1.6;
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

        .recent-post-content h6 {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .recent-post-content h6 a {
            color: var(--heading-color);
            text-decoration: none;
        }

        .recent-post-content h6 a:hover {
            color: var(--primary-color);
        }

        .recent-post-date {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .category-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e9ecef;
        }

        .category-item:last-child {
            border-bottom: none;
        }

        .category-item a {
            color: var(--body-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .category-item a:hover {
            color: var(--primary-color);
        }

        .category-count {
            background: var(--light-green);
            color: var(--secondary-color);
            padding: 0.2rem 0.5rem;
            border-radius: 12px;
            font-size: 0.8rem;
        }

        .related-posts {
            margin-top: 4rem;
        }

        .related-posts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .related-post-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .related-post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .related-post-img {
            height: 180px;
            overflow: hidden;
        }

        .related-post-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .related-post-card:hover .related-post-img img {
            transform: scale(1.05);
        }

        .related-post-content {
            padding: 1.5rem;
        }

        .related-post-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .related-post-title a {
            color: var(--heading-color);
            text-decoration: none;
        }

        .related-post-title a:hover {
            color: var(--primary-color);
        }

        .related-post-excerpt {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .navigation-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid #e9ecef;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--secondary-color);
            transform: translateX(5px);
        }

        .nav-link.prev:hover {
            transform: translateX(-5px);
        }

        @media (max-width: 768px) {
            .blog-hero {
                padding: 40px 0 30px;
            }

            .blog-title {
                font-size: 2rem;
            }

            .blog-featured-image {
                height: 250px;
            }

            .blog-meta {
                flex-direction: column;
                gap: 1rem;
            }

            .author-box {
                flex-direction: column;
                text-align: center;
            }

            .blog-share {
                justify-content: center;
            }

            .navigation-links {
                flex-direction: column;
                gap: 1rem;
            }

            .related-posts-grid {
                grid-template-columns: 1fr;
            }
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
                <nav aria-label="breadcrumbs">
                    <ol class="breadcrumbs list-unstyled d-flex gap-2 flex-wrap align-items-center mb-0">
                        <li class="breadcrumbs-item"><a href="index.php">Home</a></li>
                        <li>></li>
                        <li class="breadcrumbs-item"><a href="blogs.php">Blog</a></li>
                        <li>></li>
                        <li class="breadcrumbs-item fw-bold" aria-current="page">
                            <?= htmlspecialchars($blog['title']); ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </section>

        <!-- Blog Content -->
        <section class="blog-content">
            <div class="container">
                <div class="row">
                    <!-- Main Content -->
                    <div class="col-12">
                        <article class="blog-post">
                            <!-- Blog Header -->
                            <header class="blog-header">
                                <h1 class="blog-title"><?= htmlspecialchars($blog['title']); ?></h1>

                                <div class="blog-meta">
                                    <div class="blog-meta-item">
                                        <i class="fas fa-user"></i>
                                        <span><?= 'Oosa Herbal Ventures'; ?></span>
                                    </div>
                                    <div class="blog-meta-item">
                                        <i class="fas fa-calendar"></i>
                                        <span><?= date('F j, Y', strtotime($blog['created_at'])); ?></span>
                                    </div>

                                </div>
                            </header>

                            <!-- Featured Image -->
                            <?php if (!empty($blog['image'])): ?>
                                <img src="uploads/blog/<?= htmlspecialchars($blog['image']); ?>"
                                    alt="<?= htmlspecialchars($blog['title']); ?>" class="blog-featured-image">
                            <?php endif; ?>

                            <!-- Blog Content -->
                            <div class="blog-content-text">
                                <?= $blog['content']; ?>
                            </div>

                            <!-- Blog Footer -->
                            <footer class="blog-footer">
                                <!-- Tags -->
                                <?php if (!empty($tags)): ?>
                                    <div class="blog-tags">
                                        <strong>Tags: </strong>
                                        <?php foreach ($tags as $tag): ?>
                                            <a href="blogs.php?s=<?= urlencode(trim($tag)); ?>" class="tag">
                                                <?= htmlspecialchars(trim($tag)); ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Share Buttons -->
                                <!-- <div class="blog-share">
                                    <strong>Share this post:</strong>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>"
                                        class="share-btn facebook" target="_blank" rel="noopener">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url=<?= urlencode("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>&text=<?= urlencode($blog['title']); ?>"
                                        class="share-btn twitter" target="_blank" rel="noopener">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>"
                                        class="share-btn linkedin" target="_blank" rel="noopener">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a href="https://api.whatsapp.com/send?text=<?= urlencode($blog['title'] . ' - ' . "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>"
                                        class="share-btn whatsapp" target="_blank" rel="noopener">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div> -->
                            </footer>
                        </article>

                        <!-- Author Box -->
                        <div class="">

                            <div class="author-info">
                                <h4><?= htmlspecialchars($blog['author'] ?? 'Oosa Herbal Ventures Team'); ?></h4>
                                <p class="author-bio">
                                    <?= htmlspecialchars($blog['author_bio'] ?? 'Expert in natural health and herbal remedies, dedicated to sharing knowledge about holistic wellness and natural healing solutions.'); ?>
                                </p>
                            </div>
                        </div>


                    </div>


                </div>
            </div>
        </section>

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

        <!-- Reading Progress Bar -->


        <!-- Social Share Tracking -->
        <script>
            function trackShare(platform) {
                // Add your analytics tracking code here
                console.log('Shared on: ' + platform);
                // Example: gtag('event', 'share', { method: platform });
            }

            // Add tracking to share buttons
            document.querySelectorAll('.share-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const platform = this.classList[1]; // Gets the platform class
                    trackShare(platform);
                });
            });
        </script>
    </div>
</body>

</html>