<?php
/**
 * Ahmednagar Connect - Rural Infrastructure Monitoring System
 * Module: Progress Update
 */

$officerName = "Gram Panchayat Officer";

$progressCards = [
    ["title" => "Road Works", "value" => "84%", "note" => "Average completion"],
    ["title" => "Water Projects", "value" => "67%", "note" => "Pending materials"],
    ["title" => "Sanitation", "value" => "91%", "note" => "On schedule"],
];

$timeline = [
    ["date" => "20 Jul 2026", "title" => "Site inspection completed", "detail" => "Joint inspection held for Ward 3 road work."],
    ["date" => "18 Jul 2026", "title" => "Material delivery updated", "detail" => "Cement and pipes received for water tank repair."],
    ["date" => "15 Jul 2026", "title" => "Progress report submitted", "detail" => "Uploaded latest status for Community Hall project."],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Progress Update | Ahmednagar Connect</title>
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
                <li class="active">
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
                <li>
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
                <h1>Progress Update, <?php echo htmlspecialchars($officerName); ?> <span>📈</span></h1>
                <p>Track the latest progress of public works and field activities.</p>
            </div>
        </section>

        <section class="stats-grid">
            <?php foreach ($progressCards as $card): ?>
            <div class="stat-card">
                <div class="stat-icon stat-icon-primary">
                    <i class="fa-solid fa-chart-column"></i>
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
                <h2>Progress Table</h2>
                <a href="#" class="section-link">Add Update</a>
            </div>
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Current Status</th>
                            <th>Progress</th>
                            <th>Officer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Village Road Concreting - Ward 3</td>
                            <td><span class="badge badge-success">Completed</span></td>
                            <td>100%</td>
                            <td>Executive Engineer</td>
                        </tr>
                        <tr>
                            <td>Overhead Water Tank Repair</td>
                            <td><span class="badge badge-warning">Ongoing</span></td>
                            <td>62%</td>
                            <td>Junior Engineer</td>
                        </tr>
                        <tr>
                            <td>Community Hall Construction</td>
                            <td><span class="badge badge-danger">Pending</span></td>
                            <td>8%</td>
                            <td>Site Supervisor</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="panel">
            <div class="section-header">
                <h2>Recent Activity Timeline</h2>
            </div>
            <ul class="activity-list">
                <?php foreach ($timeline as $item): ?>
                <li>
                    <div class="activity-icon"><i class="fa-solid fa-circle-check"></i></div>
                    <div class="activity-text">
                        <p><strong><?php echo htmlspecialchars($item['title']); ?></strong></p>
                        <span><?php echo htmlspecialchars($item['date']); ?> — <?php echo htmlspecialchars($item['detail']); ?></span>
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
