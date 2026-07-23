<?php
/**
 * Ahmednagar Connect - Rural Infrastructure Monitoring System
 * Module: New Work Registration
 */

$officerName = "Gram Panchayat Officer";
$categories = ["Road", "Water Supply", "School", "Health", "Electricity"];
$fundingSchemes = ["MGNREGA", "15th Finance Commission Grant", "Jal Jeevan Mission", "State Rural Development Fund"];

$locale = isset($_GET['lang']) && $_GET['lang'] === 'mr' ? 'mr' : 'en';
$lang = require dirname(__DIR__) . '/lang/' . $locale . '.php';

$translations = array_merge([
    'page_title' => 'New Work Registration | Ahmednagar Connect',
    'topbar_title_main' => 'Ahmednagar Connect',
    'topbar_title_sub' => 'Gram Panchayat Dashboard',
    'topbar_menu_label' => 'Menu',
    'topbar_notifications_title' => 'Notifications',
    'topbar_profile_title' => 'Profile',
    'page_heading' => 'New Work Registration',
    'page_subtext' => 'Register a new rural infrastructure project under your Gram Panchayat.',
    'form_title' => 'Work Registration Form',
    'label_project_name' => 'Project Name',
    'placeholder_project_name' => 'Enter project name',
    'label_category' => 'Category',
    'placeholder_select_category' => 'Select category',
    'label_funding_scheme' => 'Funding Scheme',
    'placeholder_select_scheme' => 'Select scheme',
    'label_village_name' => 'Village Name',
    'placeholder_village_name' => 'Enter village name',
    'label_ward_number' => 'Ward Number',
    'placeholder_ward_number' => 'Ward 3',
    'label_estimated_cost' => 'Estimated Cost',
    'placeholder_estimated_cost' => '₹',
    'label_description' => 'Project Description',
    'placeholder_description' => 'Describe the project details',
    'button_submit' => 'Submit',
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
                <li class="active">
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
                <li>
                    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i><span><?php echo htmlspecialchars(t('menu_logout', $translations)); ?></span></a>
                </li>
            </ul>
        </nav>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <main class="main-content">
        <section class="welcome-card">
            <div>
                <h1><?php echo htmlspecialchars(t('page_heading', $translations)); ?>, <?php echo htmlspecialchars($officerName); ?> <span>📝</span></h1>
                <p><?php echo htmlspecialchars(t('page_subtext', $translations)); ?></p>
            </div>
        </section>

        <section class="panel">
            <div class="section-header">
                <h2><?php echo htmlspecialchars(t('form_title', $translations)); ?></h2>
            </div>
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="projectName"><?php echo htmlspecialchars(t('label_project_name', $translations)); ?></label>
                    <input type="text" id="projectName" class="form-control" placeholder="<?php echo htmlspecialchars(t('placeholder_project_name', $translations)); ?>">
                </div>
                <div class="form-group">
                    <label for="projectCategory"><?php echo htmlspecialchars(t('label_category', $translations)); ?></label>
                    <select id="projectCategory" class="form-control">
                        <option value=""><?php echo htmlspecialchars(t('placeholder_select_category', $translations)); ?></option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo htmlspecialchars($cat); ?>"><?php echo htmlspecialchars($cat); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fundingScheme"><?php echo htmlspecialchars(t('label_funding_scheme', $translations)); ?></label>
                    <select id="fundingScheme" class="form-control">
                        <option value=""><?php echo htmlspecialchars(t('placeholder_select_scheme', $translations)); ?></option>
                        <?php foreach ($fundingSchemes as $scheme): ?>
                            <option value="<?php echo htmlspecialchars($scheme); ?>"><?php echo htmlspecialchars($scheme); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="villageName"><?php echo htmlspecialchars(t('label_village_name', $translations)); ?></label>
                    <input type="text" id="villageName" class="form-control" placeholder="<?php echo htmlspecialchars(t('placeholder_village_name', $translations)); ?>">
                </div>
                <div class="form-group">
                    <label for="wardNumber"><?php echo htmlspecialchars(t('label_ward_number', $translations)); ?></label>
                    <input type="text" id="wardNumber" class="form-control" placeholder="<?php echo htmlspecialchars(t('placeholder_ward_number', $translations)); ?>">
                </div>
                <div class="form-group">
                    <label for="estimatedCost"><?php echo htmlspecialchars(t('label_estimated_cost', $translations)); ?></label>
                    <input type="number" id="estimatedCost" class="form-control" placeholder="<?php echo htmlspecialchars(t('placeholder_estimated_cost', $translations)); ?>">
                </div>
                <div class="form-group full-width">
                    <label for="description"><?php echo htmlspecialchars(t('label_description', $translations)); ?></label>
                    <textarea id="description" class="form-control" placeholder="<?php echo htmlspecialchars(t('placeholder_description', $translations)); ?>"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i> <?php echo htmlspecialchars(t('button_submit', $translations)); ?></button>
                </div>
            </div>
        </section>
    </main>
</div>

<footer class="footer">
    <p><?php echo htmlspecialchars(t('footer_copy', $translations)); ?></p>
</footer>

<script src="script.js"></script>
</body>
</html>
