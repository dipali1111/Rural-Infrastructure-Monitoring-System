<?php
/**
 * header.php
 * Sticky top header: logo, title, breadcrumb, search, notifications,
 * language dropdown, profile and logout.
 * Expects $page_title and $breadcrumb to be set by the including page.
 */
require_once __DIR__ . '/language.php';
if (!isset($page_title)) { $page_title = 'Dashboard'; }
if (!isset($breadcrumb)) { $breadcrumb = 'Dashboard'; }
// Compute base path so links resolve when app is in a subdirectory
$__ac_base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
if ($__ac_base === '/' || $__ac_base === '.') { $__ac_base = ''; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, viewport-fit=cover">
<meta name="theme-color" content="#133336">
<meta name="description" content="Ahmednagar Connect - Rural Infrastructure Monitoring System">
<title><?php echo htmlspecialchars($page_title); ?> | Ahmednagar Connect</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<!-- Custom Styles -->
<link rel="stylesheet" href="assets/css/style.css">
<!-- Responsive Complete Styles -->
<link rel="stylesheet" href="assets/css/responsive-complete.css">
<!-- Enhanced Responsive Utilities -->
<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>

<!-- ============ TOP HEADER ============ -->
<header class="ac-header">
    <div class="ac-header-left">
        <button class="ac-sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
            <i class="bi bi-list"></i>
        </button>
        <img src="assets/images/logo.jpeg" alt="Ahmednagar Connect Logo" class="ac-logo">
        <div class="ac-brand">
            <span class="ac-brand-title"><?php echo htmlspecialchars(t('brand_title')); ?></span>
            <span class="ac-brand-subtitle"><?php echo htmlspecialchars(t('brand_subtitle')); ?></span>
        </div>
    </div>

    <div class="ac-header-search d-none d-lg-flex">
        <i class="bi bi-search"></i>
        <input type="text" placeholder="<?php echo htmlspecialchars(t('search_placeholder')); ?>">
    </div>

    <button class="ac-icon-btn d-flex d-lg-none" aria-label="Search" type="button">
        <i class="bi bi-search"></i>
    </button>

    <div class="ac-header-right">
        <div class="dropdown">
            <button class="ac-icon-btn" data-bs-toggle="dropdown" aria-label="Notifications">
                <i class="bi bi-bell"></i>
                <span class="ac-badge-dot">4</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end ac-dropdown">
                <li class="ac-dropdown-title"><?php echo htmlspecialchars(t('notifications')); ?></li>
                <li><a class="dropdown-item" href="<?php echo $__ac_base . '/alerts.php'; ?>"><i class="bi bi-exclamation-triangle text-danger me-2"></i>Budget exceeded — Kopargaon</a></li>
                <li><a class="dropdown-item" href="<?php echo $__ac_base . '/alerts.php'; ?>"><i class="bi bi-file-earmark-excel text-warning me-2"></i>Missing documents — Sangamner</a></li>
                <li><a class="dropdown-item" href="<?php echo $__ac_base . '/alerts.php'; ?>"><i class="bi bi-clock-history text-danger me-2"></i>Late progress — Nevasa</a></li>
                <li><a class="dropdown-item" href="<?php echo $__ac_base . '/alerts.php'; ?>"><i class="bi bi-patch-question text-info me-2"></i>Verification pending — Rahata</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-center small" href="<?php echo $__ac_base . '/alerts.php'; ?>"><?php echo htmlspecialchars(t('view_all_alerts')); ?></a></li>
            </ul>
        </div>

        <div class="dropdown">
            <button class="ac-icon-btn ac-lang-btn" data-bs-toggle="dropdown" aria-label="Language">
                <i class="bi bi-translate"></i>
                <span class="d-none d-md-inline ms-1"><?php echo strtoupper($lang); ?></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end ac-dropdown">
                <li><a class="dropdown-item" href="?lang=en">English</a></li>
                <li><a class="dropdown-item" href="?lang=mr">मराठी (Marathi)</a></li>
            </ul>
        </div>

        <div class="dropdown">
            <button class="ac-profile-btn" data-bs-toggle="dropdown">
                <img src="assets/images/logo.png" alt="Profile" class="ac-profile-img">
                <span class="d-none d-lg-flex flex-column align-items-start">
                    <span class="ac-profile-name"><?php echo htmlspecialchars(t('profile_name')); ?></span>
                    <span class="ac-profile-role"><?php echo htmlspecialchars(t('profile_role')); ?></span>
                </span>
                <i class="bi bi-chevron-down d-none d-lg-inline"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end ac-dropdown">
                <li><a class="dropdown-item" href="<?php echo $__ac_base . '/profile.php'; ?>"><i class="bi bi-person me-2"></i><?php echo htmlspecialchars(t('my_profile')); ?></a></li>
                <li><a class="dropdown-item" href="<?php echo $__ac_base . '/settings.php'; ?>"><i class="bi bi-gear me-2"></i><?php echo htmlspecialchars(t('settings')); ?></a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="<?php echo $__ac_base . '/logout.php'; ?>"><i class="bi bi-box-arrow-right me-2"></i><?php echo htmlspecialchars(t('logout')); ?></a></li>
            </ul>
        </div>
    </div>
</header>

<div class="ac-body-wrapper">
