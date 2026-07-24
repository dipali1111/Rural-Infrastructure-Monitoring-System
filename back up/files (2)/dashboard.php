<?php
/**
 * Ahmednagar Connect - Rural Infrastructure Monitoring System
 * Module: Gram Panchayat Dashboard
 */

$officerName = "Gram Panchayat Officer";

$locale = isset($_GET['lang']) && $_GET['lang'] === 'mr' ? 'mr' : 'en';
$lang = require dirname(__DIR__) . '/lang/' . $locale . '.php';

$translations = array_merge([
    'page_title' => 'Gram Panchayat Dashboard | Ahmednagar Connect',
    'topbar_title_main' => 'Ahmednagar Connect',
    'topbar_title_sub' => 'Gram Panchayat Dashboard',
    'topbar_menu_label' => 'Menu',
    'topbar_notifications_title' => 'Notifications',
    'topbar_profile_title' => 'Profile',
    'view_details_title' => 'View Details',
    'activity_street_light' => 'Street Light Installation marked as <strong>Completed</strong>',
    'activity_photos_uploaded' => 'Photos uploaded for Drainage Line - Sector 5',
    'activity_document_submitted' => 'Document submitted for Community Hall Construction',
    'activity_new_work_registered' => 'New work registered: Overhead Water Tank Repair',
    'notif_progress_pending' => 'Progress report pending for GP-1042',
    'notif_fund_release' => 'Fund release approved for Ward 3 Road Works',
    'notif_document_verification' => 'Document verification failed for GP-1031',
    'notif_review_meeting' => 'Quarterly review meeting scheduled',
    'activity_time_1' => '12 Jul 2026, 10:20 AM',
    'activity_time_2' => '20 Jul 2026, 09:05 AM',
    'activity_time_3' => '15 Jul 2026, 04:40 PM',
    'activity_time_4' => '10 Jul 2026, 11:15 AM',
    'notif_time_1' => '2 hours ago',
    'notif_time_2' => '1 day ago',
    'notif_time_3' => '2 days ago',
    'notif_time_4' => '3 days ago',
], $lang);

function t($key, $translations) {
    return isset($translations[$key]) ? $translations[$key] : $key;
}

// Dummy statistics
$stats = [
    "total"     => 128,
    "ongoing"   => 42,
    "completed" => 71,
    "pending"   => 15
];

// Dummy recent works
$recentWorks = [
    ["id" => "GP-1024", "name" => "Village Road Concreting - Ward 3", "category" => "Road", "status" => "Completed", "progress" => 100, "updated" => "18 Jul 2026"],
    ["id" => "GP-1031", "name" => "Overhead Water Tank Repair", "category" => "Water Supply", "status" => "Ongoing", "progress" => 62, "updated" => "19 Jul 2026"],
    ["id" => "GP-1042", "name" => "Community Hall Construction", "category" => "Building", "status" => "Pending", "progress" => 8, "updated" => "15 Jul 2026"],
    ["id" => "GP-1050", "name" => "Drainage Line - Sector 5", "category" => "Sanitation", "status" => "Ongoing", "progress" => 45, "updated" => "20 Jul 2026"],
    ["id" => "GP-1058", "name" => "Street Light Installation", "category" => "Electrical", "status" => "Completed", "progress" => 100, "updated" => "12 Jul 2026"],
];

function statusBadgeClass($status) {
    switch ($status) {
        case "Completed": return "badge-success";
        case "Ongoing":   return "badge-warning";
        case "Pending":   return "badge-danger";
        default: return "";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars(t('page_title', $translations)); ?></title>

<!-- Google Font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Custom CSS -->
<link rel="stylesheet" href="style.css">
</head>
<body>

<!-- ===================== TOP HEADER ===================== -->
<header class="topbar">
    <div class="topbar-left">
        <button class="menu-toggle" id="menuToggle" title="<?php echo htmlspecialchars(t('topbar_menu_label', $translations)); ?>">
            <i class="fa-solid fa-bars"></i>
        </button>
        <img src="assets/logo.png" alt="<?php echo htmlspecialchars(t('topbar_title_main', $translations)); ?> Logo" class="topbar-logo">
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

    <!-- ===================== SIDEBAR ===================== -->
    <aside class="sidebar" id="sidebar">
        <nav class="sidebar-nav">
            <ul>
                <li class="active">
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
                <li>
                    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i><span><?php echo htmlspecialchars(t('menu_logout', $translations)); ?></span></a>
                </li>
            </ul>
        </nav>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ===================== MAIN CONTENT ===================== -->
    <main class="main-content">

        <!-- Welcome Card -->
        <section class="welcome-card">
            <div>
                <h1><?php echo htmlspecialchars(t('welcome_back', $translations)); ?>, <?php echo htmlspecialchars($officerName); ?> <span>👋</span></h1>
                <p><?php echo htmlspecialchars(t('manage_projects', $translations)); ?></p>
            </div>
        </section>

        <!-- Statistics -->
        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon stat-icon-primary">
                    <i class="fa-solid fa-diagram-project"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-value"><?php echo $stats['total']; ?></span>
                    <span class="stat-label"><?php echo htmlspecialchars(t('stats_total_works', $translations)); ?></span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon stat-icon-warning">
                    <i class="fa-solid fa-person-digging"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-value"><?php echo $stats['ongoing']; ?></span>
                    <span class="stat-label"><?php echo htmlspecialchars(t('stats_ongoing_works', $translations)); ?></span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon stat-icon-success">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-value"><?php echo $stats['completed']; ?></span>
                    <span class="stat-label"><?php echo htmlspecialchars(t('stats_completed_works', $translations)); ?></span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon stat-icon-danger">
                    <i class="fa-solid fa-hourglass-half"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-value"><?php echo $stats['pending']; ?></span>
                    <span class="stat-label"><?php echo htmlspecialchars(t('stats_pending_works', $translations)); ?></span>
                </div>
            </div>
        </section>

        <!-- Chart Section -->
        <section class="chart-section">
            <div class="section-header">
                <h2><?php echo htmlspecialchars(t('monthly_progress', $translations)); ?></h2>
            </div>
            <div class="chart-placeholder">
                <i class="fa-solid fa-chart-column"></i>
                <p><?php echo htmlspecialchars(t('chart_placeholder', $translations)); ?></p>
            </div>
        </section>

        <!-- Recent Works Table -->
        <section class="table-section">
            <div class="section-header">
                <h2><?php echo htmlspecialchars(t('recent_works', $translations)); ?></h2>
                <a href="#" class="section-link"><?php echo htmlspecialchars(t('view_all', $translations)); ?></a>
            </div>

            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th><?php echo htmlspecialchars(t('table_project_id', $translations)); ?></th>
                            <th><?php echo htmlspecialchars(t('table_project_name', $translations)); ?></th>
                            <th><?php echo htmlspecialchars(t('table_category', $translations)); ?></th>
                            <th><?php echo htmlspecialchars(t('table_status', $translations)); ?></th>
                            <th><?php echo htmlspecialchars(t('table_progress', $translations)); ?></th>
                            <th><?php echo htmlspecialchars(t('table_last_updated', $translations)); ?></th>
                            <th><?php echo htmlspecialchars(t('table_action', $translations)); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentWorks as $work): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($work['id']); ?></td>
                            <td><?php echo htmlspecialchars($work['name']); ?></td>
                            <td><?php echo htmlspecialchars($work['category']); ?></td>
                            <td>
                                <span class="badge <?php echo statusBadgeClass($work['status']); ?>">
                                    <?php echo htmlspecialchars($work['status']); ?>
                                </span>
                            </td>
                            <td>
                                <div class="progress-wrapper">
                                    <div class="progress-track">
                                        <div class="progress-fill" style="width: <?php echo (int)$work['progress']; ?>%;"></div>
                                    </div>
                                    <span class="progress-text"><?php echo (int)$work['progress']; ?>%</span>
                                </div>
                            </td>
                            <td><?php echo htmlspecialchars($work['updated']); ?></td>
                            <td>
                                <button class="action-btn" title="<?php echo htmlspecialchars(t('view_details_title', $translations)); ?>">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Bottom Section -->
        <section class="bottom-grid">
            <div class="panel">
                <div class="section-header">
                    <h2><?php echo htmlspecialchars(t('recent_activities', $translations)); ?></h2>
                </div>
                <ul class="activity-list">
                    <li>
                        <div class="activity-icon"><i class="fa-solid fa-circle-check"></i></div>
                        <div class="activity-text">
                            <p><?php echo t('activity_street_light', $translations); ?></p>
                            <span><?php echo htmlspecialchars(t('activity_time_1', $translations)); ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="activity-icon"><i class="fa-solid fa-camera"></i></div>
                        <div class="activity-text">
                            <p><?php echo t('activity_photos_uploaded', $translations); ?></p>
                            <span><?php echo htmlspecialchars(t('activity_time_2', $translations)); ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="activity-icon"><i class="fa-solid fa-file-arrow-up"></i></div>
                        <div class="activity-text">
                            <p><?php echo t('activity_document_submitted', $translations); ?></p>
                            <span><?php echo htmlspecialchars(t('activity_time_3', $translations)); ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="activity-icon"><i class="fa-solid fa-square-plus"></i></div>
                        <div class="activity-text">
                            <p><?php echo t('activity_new_work_registered', $translations); ?></p>
                            <span><?php echo htmlspecialchars(t('activity_time_4', $translations)); ?></span>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="panel">
                <div class="section-header">
                    <h2><?php echo htmlspecialchars(t('notifications', $translations)); ?></h2>
                </div>
                <ul class="notification-list">
                    <li>
                        <div class="notif-dot notif-warning"></div>
                        <div class="activity-text">
                            <p><?php echo htmlspecialchars(t('notif_progress_pending', $translations)); ?></p>
                            <span><?php echo htmlspecialchars(t('notif_time_1', $translations)); ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="notif-dot notif-success"></div>
                        <div class="activity-text">
                            <p><?php echo htmlspecialchars(t('notif_fund_release', $translations)); ?></p>
                            <span><?php echo htmlspecialchars(t('notif_time_2', $translations)); ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="notif-dot notif-danger"></div>
                        <div class="activity-text">
                            <p><?php echo htmlspecialchars(t('notif_document_verification', $translations)); ?></p>
                            <span><?php echo htmlspecialchars(t('notif_time_3', $translations)); ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="notif-dot notif-primary"></div>
                        <div class="activity-text">
                            <p><?php echo htmlspecialchars(t('notif_review_meeting', $translations)); ?></p>
                            <span><?php echo htmlspecialchars(t('notif_time_4', $translations)); ?></span>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

    </main>
</div>

<!-- ===================== FOOTER ===================== -->
<footer class="footer">
    <p><?php echo htmlspecialchars(t('footer_copy', $translations)); ?></p>
</footer>

<script src="script.js"></script>
</body>
</html>
