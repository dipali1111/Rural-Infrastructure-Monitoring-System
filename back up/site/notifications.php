<?php
/**
 * Ahmednagar Connect - Rural Infrastructure Monitoring System
 * Module: Notifications
 */

$officerName = "Gram Panchayat Officer";

$notifications = [
    ["title" => "Progress report pending for GP-1042", "time" => "2 hours ago", "type" => "warning"],
    ["title" => "Fund release approved for Ward 3 Road Works", "time" => "1 day ago", "type" => "success"],
    ["title" => "Document verification failed for GP-1031", "time" => "2 days ago", "type" => "danger"],
    ["title" => "Quarterly review meeting scheduled", "time" => "3 days ago", "type" => "primary"],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notifications | Ahmednagar Connect</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<header class="topbar">
    <div class="topbar-left">
        <button class="menu-toggle" id="menuToggle" title="Menu">
            <i class="fa-solid fa-bars"></i>
        </button>
        <img src="assets/logo.png" alt="Ahmednagar Connect Logo" class="topbar-logo">
        <div class="topbar-title">
            <span class="topbar-title-main">Ahmednagar Connect</span>
            <span class="topbar-title-sub">Gram Panchayat Dashboard</span>
        </div>
    </div>
    <div class="topbar-center"></div>
    <div class="topbar-right">
        <div class="lang-switch">
            <a href="#" class="lang-active">English</a>
            <span class="lang-sep">|</span>
            <a href="#">मराठी</a>
        </div>
        <button class="icon-btn" title="Notifications">
            <i class="fa-regular fa-bell"></i>
            <span class="icon-dot"></span>
        </button>
        <button class="icon-btn" title="Profile">
            <i class="fa-regular fa-circle-user"></i>
        </button>
        <button class="logout-btn" title="Logout">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </button>
    </div>
</header>

<div class="app-body">
    <aside class="sidebar" id="sidebar">
        <nav class="sidebar-nav">
            <ul>
                <li>
                    <a href="dashboard.php"><i class="fa-solid fa-house"></i><span>Dashboard</span></a>
                </li>
                <li>
                    <a href="new_work.php"><i class="fa-solid fa-square-plus"></i><span>New Work Registration</span></a>
                </li>
                <li>
                    <a href="my_works.php"><i class="fa-solid fa-clipboard-list"></i><span>My Works</span></a>
                </li>
                <li>
                    <a href="progress_update.php"><i class="fa-solid fa-chart-line"></i><span>Progress Update</span></a>
                </li>
                <li>
                    <a href="upload_photos.php"><i class="fa-solid fa-camera"></i><span>Upload Photos</span></a>
                </li>
                <li>
                    <a href="upload_documents.php"><i class="fa-solid fa-file-arrow-up"></i><span>Upload Documents</span></a>
                </li>
                <li>
                    <a href="financial_details.php"><i class="fa-solid fa-sack-dollar"></i><span>Financial Details</span></a>
                </li>
                <li class="active">
                    <a href="notifications.php"><i class="fa-solid fa-bullhorn"></i><span>Notifications</span></a>
                </li>
                <li>
                    <a href="profile.php"><i class="fa-solid fa-user"></i><span>Profile</span></a>
                </li>
                <li>
                    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i><span>Logout</span></a>
                </li>
            </ul>
        </nav>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <main class="main-content">
        <section class="welcome-card">
            <div>
                <h1>Notifications, <?php echo htmlspecialchars($officerName); ?> <span>🔔</span></h1>
                <p>Stay updated with government alerts, approvals, and review notices.</p>
            </div>
        </section>

        <section class="panel">
            <div class="section-header">
                <h2>Government Alerts</h2>
            </div>
            <ul class="notification-list">
                <?php foreach ($notifications as $alert): ?>
                <li>
                    <div class="notif-dot notif-<?php echo htmlspecialchars($alert['type']); ?>"></div>
                    <div class="activity-text">
                        <p><?php echo htmlspecialchars($alert['title']); ?></p>
                        <span><?php echo htmlspecialchars($alert['time']); ?></span>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>
</div>

<footer class="footer">
    <p>&copy; 2025 Ahmednagar Connect &nbsp;|&nbsp; Version 1.0</p>
</footer>

<script src="script.js"></script>
</body>
</html>
