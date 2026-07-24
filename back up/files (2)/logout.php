<?php
/**
 * Ahmednagar Connect - Rural Infrastructure Monitoring System
 * Module: Logout
 */

$officerName = "Gram Panchayat Officer";

$locale = isset($_GET['lang']) && $_GET['lang'] === 'mr' ? 'mr' : 'en';
$lang = require dirname(__DIR__) . '/lang/' . $locale . '.php';

$translations = array_merge([
    'page_title' => 'Logout | Ahmednagar Connect',
    'topbar_title_main' => 'Ahmednagar Connect',
    'topbar_title_sub' => 'Gram Panchayat Dashboard',
    'topbar_menu_label' => 'Menu',
    'topbar_notifications_title' => 'Notifications',
    'topbar_profile_title' => 'Profile',
    'page_heading' => 'Logout',
    'page_subtext' => 'You are about to leave the dashboard session.',
    'session_end' => 'Session End',
    'session_message' => 'Thank you for updating the rural infrastructure records. You can safely end your session or return to the dashboard.',
    'button_dashboard' => 'Go to Dashboard',
    'button_login_again' => 'Login Again',
    'page_icon_alt' => 'Ahmednagar Connect Logo',
    'footer_copy' => '© 2025 Ahmednagar Connect | Version 1.0',
    'language_english' => 'English',
    'language_marathi' => 'मराठी',
], $lang);

function t($key, $translations) {
    return isset($translations[$key]) ? $translations[$key] : $key;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars(t('page_title', $translations)); ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<header class="topbar">
    <div class="topbar-left">
        <button class="menu-toggle" id="menuToggle" title="<?php echo htmlspecialchars(t('topbar_menu_label', $translations)); ?>">
            <i class="fa-solid fa-bars"></i>
        </button>
        <img src="assets/logo.png" alt="<?php echo htmlspecialchars(t('page_icon_alt', $translations)); ?>" class="topbar-logo">
        <div class="topbar-title">
            <span class="topbar-title-main"><?php echo htmlspecialchars(t('topbar_title_main', $translations)); ?></span>
            <span class="topbar-title-sub"><?php echo htmlspecialchars(t('topbar_title_sub', $translations)); ?></span>
        </div>
    </div>
    <div class="topbar-center"></div>
    <div class="topbar-right">
        <div class="lang-switch">
            <a href="?lang=en" class="lang-active"><?php echo htmlspecialchars(t('language_english', $translations)); ?></a>
            <span class="lang-sep">|</span>
            <a href="?lang=mr"><?php echo htmlspecialchars(t('language_marathi', $translations)); ?></a>
        </div>
        <button class="icon-btn" title="<?php echo htmlspecialchars(t('topbar_notifications_title', $translations)); ?>">
            <i class="fa-regular fa-bell"></i>
            <span class="icon-dot"></span>
        </button>
        <button class="icon-btn" title="<?php echo htmlspecialchars(t('topbar_profile_title', $translations)); ?>">
            <i class="fa-regular fa-circle-user"></i>
        </button>
        <button class="logout-btn" title="<?php echo htmlspecialchars(t('menu_logout', $translations)); ?>">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span><?php echo htmlspecialchars(t('menu_logout', $translations)); ?></span>
        </button>
    </div>
</header>

<div class="app-body">
    <aside class="sidebar" id="sidebar">
        <nav class="sidebar-nav">
            <ul>
                <li>
                    <a href="dashboard.php"><i class="fa-solid fa-house"></i><span><?php echo htmlspecialchars(t('menu_dashboard', $translations)); ?></span></a>
                </li>
                <li>
                    <a href="new_work.php"><i class="fa-solid fa-square-plus"></i><span><?php echo htmlspecialchars(t('menu_new_work', $translations)); ?></span></a>
                </li>
                <li>
                    <a href="my_works.php"><i class="fa-solid fa-clipboard-list"></i><span><?php echo htmlspecialchars(t('menu_my_works', $translations)); ?></span></a>
                </li>
                <li>
                    <a href="progress_update.php"><i class="fa-solid fa-chart-line"></i><span><?php echo htmlspecialchars(t('menu_progress_update', $translations)); ?></span></a>
                </li>
                <li>
                    <a href="upload_photos.php"><i class="fa-solid fa-camera"></i><span><?php echo htmlspecialchars(t('menu_upload_photos', $translations)); ?></span></a>
                </li>
                <li>
                    <a href="upload_documents.php"><i class="fa-solid fa-file-arrow-up"></i><span><?php echo htmlspecialchars(t('menu_upload_documents', $translations)); ?></span></a>
                </li>
                <li>
                    <a href="financial_details.php"><i class="fa-solid fa-sack-dollar"></i><span><?php echo htmlspecialchars(t('menu_financial_details', $translations)); ?></span></a>
                </li>
                <li>
                    <a href="notifications.php"><i class="fa-solid fa-bullhorn"></i><span><?php echo htmlspecialchars(t('menu_notifications', $translations)); ?></span></a>
                </li>
                <li>
                    <a href="profile.php"><i class="fa-solid fa-user"></i><span><?php echo htmlspecialchars(t('menu_profile', $translations)); ?></span></a>
                </li>
                <li class="active">
                    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i><span><?php echo htmlspecialchars(t('menu_logout', $translations)); ?></span></a>
                </li>
            </ul>
        </nav>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <main class="main-content">
        <section class="welcome-card">
            <div>
                <h1><?php echo htmlspecialchars(t('page_heading', $translations)); ?>, <?php echo htmlspecialchars($officerName); ?> <span>🚪</span></h1>
                <p><?php echo htmlspecialchars(t('page_subtext', $translations)); ?></p>
            </div>
        </section>

        <section class="panel">
            <div class="section-header">
                <h2><?php echo htmlspecialchars(t('session_end', $translations)); ?></h2>
            </div>
            <p style="margin-bottom: 16px;"><?php echo htmlspecialchars(t('session_message', $translations)); ?></p>
            <a href="dashboard.php" class="btn btn-primary"><i class="fa-solid fa-house"></i> <?php echo htmlspecialchars(t('button_dashboard', $translations)); ?></a>
            <a href="#" class="btn btn-outline" style="margin-left: 10px;"><i class="fa-solid fa-right-from-bracket"></i> <?php echo htmlspecialchars(t('button_login_again', $translations)); ?></a>
        </section>
    </main>
</div>

<footer class="footer">
    <p><?php echo htmlspecialchars(t('footer_copy', $translations)); ?></p>
</footer>

<script src="script.js"></script>
</body>
</html>
