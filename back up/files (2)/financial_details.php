<?php
/**
 * Ahmednagar Connect - Rural Infrastructure Monitoring System
 * Module: Financial Details
 */

$officerName = "Gram Panchayat Officer";

$locale = isset($_GET['lang']) && $_GET['lang'] === 'mr' ? 'mr' : 'en';
$lang = require dirname(__DIR__) . '/lang/' . $locale . '.php';

$translations = array_merge([
    'page_title' => 'Financial Details | Ahmednagar Connect',
    'topbar_title_main' => 'Ahmednagar Connect',
    'topbar_title_sub' => 'Gram Panchayat Dashboard',
    'topbar_menu_label' => 'Menu',
    'topbar_notifications_title' => 'Notifications',
    'topbar_profile_title' => 'Profile',
    'budget_approved' => 'Approved Budget',
    'budget_spent' => 'Spent So Far',
    'budget_balance' => 'Balance',
    'budget_current_fy' => 'Current fiscal year',
    'budget_utilization' => 'Utilization till date',
    'budget_remaining' => 'Remaining funds',
    'expenditure_summary' => 'Expenditure Summary',
    'table_work' => 'Work',
    'table_budget_head' => 'Budget Head',
    'table_amount' => 'Amount',
    'table_status' => 'Status',
    'status_approved' => 'Approved',
    'status_pending' => 'Pending',
    'page_heading' => 'Financial Details',
    'page_subtext' => 'Monitor budget allocation, expenditure, and fund utilization.',
    'page_icon_alt' => 'Ahmednagar Connect Logo',
    'work_road' => 'Ward 3 Road Work',
    'work_water' => 'Water Tank Repair',
    'work_hall' => 'Community Hall',
    'head_construction' => 'Construction',
    'head_materials' => 'Materials',
    'head_labour' => 'Labour',
    'footer_copy' => '© 2025 Ahmednagar Connect | Version 1.0',
    'language_english' => 'English',
    'language_marathi' => 'मराठी',
], $lang);

function t($key, $translations) {
    return isset($translations[$key]) ? $translations[$key] : $key;
}

$budgetCards = [
    ["title" => t('budget_approved', $translations), "value" => "₹3.42 Cr", "note" => t('budget_current_fy', $translations)],
    ["title" => t('budget_spent', $translations), "value" => "₹1.89 Cr", "note" => t('budget_utilization', $translations)],
    ["title" => t('budget_balance', $translations), "value" => "₹1.53 Cr", "note" => t('budget_remaining', $translations)],
];

$expenditure = [
    ["work" => t('work_road', $translations), "head" => t('head_construction', $translations), "amount" => "₹42,00,000", "status" => t('status_approved', $translations)],
    ["work" => t('work_water', $translations), "head" => t('head_materials', $translations), "amount" => "₹12,50,000", "status" => t('status_pending', $translations)],
    ["work" => t('work_hall', $translations), "head" => t('head_labour', $translations), "amount" => "₹18,20,000", "status" => t('status_approved', $translations)],
];
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
                <li class="active">
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
                <h1><?php echo htmlspecialchars(t('page_heading', $translations)); ?>, <?php echo htmlspecialchars($officerName); ?> <span>💰</span></h1>
                <p><?php echo htmlspecialchars(t('page_subtext', $translations)); ?></p>
            </div>
        </section>

        <section class="stats-grid">
            <?php foreach ($budgetCards as $card): ?>
            <div class="stat-card">
                <div class="stat-icon stat-icon-success">
                    <i class="fa-solid fa-indian-rupee-sign"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-value"><?php echo htmlspecialchars($card['value']); ?></span>
                    <span class="stat-label"><?php echo htmlspecialchars($card['title']); ?></span>
                    <small><?php echo htmlspecialchars($card['note']); ?></small>
                </div>
            </div>
            <?php endforeach; ?>
        </section>

        <section class="panel">
            <div class="section-header">
                <h2><?php echo htmlspecialchars(t('expenditure_summary', $translations)); ?></h2>
            </div>
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th><?php echo htmlspecialchars(t('table_work', $translations)); ?></th>
                            <th><?php echo htmlspecialchars(t('table_budget_head', $translations)); ?></th>
                            <th><?php echo htmlspecialchars(t('table_amount', $translations)); ?></th>
                            <th><?php echo htmlspecialchars(t('table_status', $translations)); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($expenditure as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['work']); ?></td>
                            <td><?php echo htmlspecialchars($item['head']); ?></td>
                            <td><?php echo htmlspecialchars($item['amount']); ?></td>
                            <td><span class="badge <?php echo $item['status'] === 'Approved' ? 'badge-success' : 'badge-warning'; ?>"><?php echo htmlspecialchars($item['status']); ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
