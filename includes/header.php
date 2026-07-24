<?php
include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../language.php';
?>
<!DOCTYPE html>
<html lang="<?php echo get_current_lang(); ?>" data-lang="<?php echo get_current_lang(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A modern landing page for rural infrastructure development and monitoring.">
    <title><?php echo $site_title; ?> - <?php echo __('portal_tagline'); ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="--primary-color: <?php echo $primary_color; ?>; --secondary-color: <?php echo $secondary_color; ?>; --dark-color: <?php echo $dark_color; ?>; --accent-color: <?php echo $accent_color; ?>;">
<header class="topbar">
    <div class="container nav-wrap">
        <a class="brand" href="index.php">
            <img src="<?php echo $logo_path; ?>" alt="<?php echo $brand_name; ?> logo">
            <span><?php echo $brand_name; ?></span>
        </a>
        <nav class="nav-links">
            <a href="#about"><?php echo __('nav_about'); ?></a>
            <a href="#services"><?php echo __('nav_services'); ?></a>
            <a href="#impact"><?php echo __('nav_impact'); ?></a>
            <a href="#contact"><?php echo __('nav_contact'); ?></a>
            <div class="language-switcher">
                <a href="?lang=en" class="lang-btn" data-lang="en" title="English">EN</a>
                <span class="lang-divider">|</span>
                <a href="?lang=mr" class="lang-btn" data-lang="mr" title="मराठी">MR</a>
            </div>
        </nav>
    </div>
</header>
