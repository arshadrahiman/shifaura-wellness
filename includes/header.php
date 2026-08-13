<?php
/**
 * SHIFAURA - Global Header Component
 */
require_once __DIR__ . '/../db/config.php';

// Function to check if a navigation link is active
function is_active_link($page_name) {
    $current_page = basename($_SERVER['PHP_SELF']);
    return ($current_page === $page_name) ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title><?php echo isset($page_title) ? $page_title . ' | ' . SITE_NAME : SITE_NAME . ' - ' . SITE_TAGLINE; ?></title>
    <meta name="description" content="<?php echo isset($page_description) ? $page_description : 'SHIFAURA by Dietitian Shifana. Personalized nutrition and holistic wellness programs built around your body, lifestyle, and goals.'; ?>">
    <meta name="keywords" content="dietitian, nutritionist, weight loss, diabetes, PCOS, thyroid health, fertility nutrition, hormonal wellness, healthy lifestyle, shifaura, shifana">
    <meta name="author" content="Dietitian Shifana">
    <link rel="canonical" href="https://www.dietitianshifana.com/">
    
    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:title" content="SHIFAURA by Dietitian Shifana - Personalized Nutrition">
    <meta property="og:description" content="Evidence-based nutrition and holistic wellness personalized to your body, lifestyle, and goals.">
    <meta property="og:url" content="https://www.dietitianshifana.com/">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://www.dietitianshifana.com/assets/images/shifana_hero.png">
    
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Feather Icons for modern vector icons (SVG) -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>

    <!-- Header Navigation -->
    <header>
        <div class="container header-inner">
            <!-- Brand Logo -->
            <a href="index.php" class="logo-img-link">
                <img src="assets/images/logo.png" alt="SHIFAURA by Dietitian Shifana" style="height: 54px; width: auto; display: block;">
            </a>

            <!-- Desktop Nav Links -->
            <nav>
                <ul class="nav-links">
                    <li><a href="index.php" class="<?php echo is_active_link('index.php'); ?>">Home</a></li>
                    <!-- <li><a href="about.php" class="<?php echo is_active_link('about.php'); ?>">About</a></li> -->
                    <!-- <li><a href="services.php" class="<?php echo is_active_link('services.php'); ?>">Services</a></li> -->
                    <!-- <li><a href="approach.php" class="<?php echo is_active_link('approach.php'); ?>">Our Approach</a></li> -->
                    <!-- <li><a href="resources.php" class="<?php echo is_active_link('resources.php'); ?>">Resources</a></li> -->
                </ul>
            </nav>

            <!-- Actions -->
            <div class="header-actions">
                <a href="index.php#book-consultation" class="btn btn-primary" id="header-cta-btn">Book Consultation</a>
                <button class="menu-toggle" aria-label="Toggle Navigation">
                    <i data-feather="menu"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div class="mobile-nav">
            <ul class="mobile-nav-links">
                <li><a href="index.php" class="<?php echo is_active_link('index.php'); ?>">Home</a></li>
                <!-- <li><a href="about.php" class="<?php echo is_active_link('about.php'); ?>">About</a></li> -->
                <!-- <li><a href="services.php" class="<?php echo is_active_link('services.php'); ?>">Services</a></li> -->
                <!-- <li><a href="approach.php" class="<?php echo is_active_link('approach.php'); ?>">Our Approach</a></li> -->
                <!-- <li><a href="resources.php" class="<?php echo is_active_link('resources.php'); ?>">Resources</a></li> -->
                <li style="margin-top: 1.5rem;"><a href="index.php#book-consultation" class="btn btn-primary" style="display: block; text-align: center; color: var(--sandal-light);">Book Consultation</a></li>
            </ul>
        </div>
    </header>
