<?php
/**
 * Ahmednagar Connect - Rural Infrastructure Monitoring System
 * Module: Gram Panchayat Dashboard
 */

$officerName = "Gram Panchayat Officer";

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
<title>Gram Panchayat Dashboard | Ahmednagar Connect</title>

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

    <!-- ===================== SIDEBAR ===================== -->
    <aside class="sidebar" id="sidebar">
        <nav class="sidebar-nav">
            <ul>
                <li class="active">
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

    <!-- ===================== MAIN CONTENT ===================== -->
    <main class="main-content">

        <!-- Welcome Card -->
        <section class="welcome-card">
            <div>
                <h1>Welcome Back, <?php echo htmlspecialchars($officerName); ?> <span>👋</span></h1>
                <p>Manage rural infrastructure projects efficiently.</p>
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
                    <span class="stat-label">Total Works</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon stat-icon-warning">
                    <i class="fa-solid fa-person-digging"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-value"><?php echo $stats['ongoing']; ?></span>
                    <span class="stat-label">Ongoing Works</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon stat-icon-success">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-value"><?php echo $stats['completed']; ?></span>
                    <span class="stat-label">Completed Works</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon stat-icon-danger">
                    <i class="fa-solid fa-hourglass-half"></i>
                </div>
                <div class="stat-info">
                    <span class="stat-value"><?php echo $stats['pending']; ?></span>
                    <span class="stat-label">Pending Works</span>
                </div>
            </div>
        </section>

        <!-- Chart Section -->
        <section class="chart-section">
            <div class="section-header">
                <h2>Monthly Work Progress</h2>
            </div>
            <div class="chart-placeholder">
                <i class="fa-solid fa-chart-column"></i>
                <p>Chart will be displayed here</p>
            </div>
        </section>

        <!-- Recent Works Table -->
        <section class="table-section">
            <div class="section-header">
                <h2>Recent Works</h2>
                <a href="#" class="section-link">View All</a>
            </div>

            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Project ID</th>
                            <th>Project Name</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Progress</th>
                            <th>Last Updated</th>
                            <th>Action</th>
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
                                <button class="action-btn" title="View Details">
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
                    <h2>Recent Activities</h2>
                </div>
                <ul class="activity-list">
                    <li>
                        <div class="activity-icon"><i class="fa-solid fa-circle-check"></i></div>
                        <div class="activity-text">
                            <p>Street Light Installation marked as <strong>Completed</strong></p>
                            <span>12 Jul 2026, 10:20 AM</span>
                        </div>
                    </li>
                    <li>
                        <div class="activity-icon"><i class="fa-solid fa-camera"></i></div>
                        <div class="activity-text">
                            <p>Photos uploaded for Drainage Line - Sector 5</p>
                            <span>20 Jul 2026, 09:05 AM</span>
                        </div>
                    </li>
                    <li>
                        <div class="activity-icon"><i class="fa-solid fa-file-arrow-up"></i></div>
                        <div class="activity-text">
                            <p>Document submitted for Community Hall Construction</p>
                            <span>15 Jul 2026, 04:40 PM</span>
                        </div>
                    </li>
                    <li>
                        <div class="activity-icon"><i class="fa-solid fa-square-plus"></i></div>
                        <div class="activity-text">
                            <p>New work registered: Overhead Water Tank Repair</p>
                            <span>10 Jul 2026, 11:15 AM</span>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="panel">
                <div class="section-header">
                    <h2>Notifications</h2>
                </div>
                <ul class="notification-list">
                    <li>
                        <div class="notif-dot notif-warning"></div>
                        <div class="activity-text">
                            <p>Progress report pending for GP-1042</p>
                            <span>2 hours ago</span>
                        </div>
                    </li>
                    <li>
                        <div class="notif-dot notif-success"></div>
                        <div class="activity-text">
                            <p>Fund release approved for Ward 3 Road Works</p>
                            <span>1 day ago</span>
                        </div>
                    </li>
                    <li>
                        <div class="notif-dot notif-danger"></div>
                        <div class="activity-text">
                            <p>Document verification failed for GP-1031</p>
                            <span>2 days ago</span>
                        </div>
                    </li>
                    <li>
                        <div class="notif-dot notif-primary"></div>
                        <div class="activity-text">
                            <p>Quarterly review meeting scheduled</p>
                            <span>3 days ago</span>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

    </main>
</div>

<!-- ===================== FOOTER ===================== -->
<footer class="footer">
    <p>&copy; 2025 Ahmednagar Connect &nbsp;|&nbsp; Version 1.0</p>
</footer>

<script src="script.js"></script>
</body>
</html>
