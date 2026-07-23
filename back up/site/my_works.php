<?php
/**
 * Ahmednagar Connect - Rural Infrastructure Monitoring System
 * Module: My Works
 */

$officerName = "Gram Panchayat Officer";

$works = [
    ["id" => "GP-1024", "name" => "Village Road Concreting - Ward 3", "category" => "Road", "status" => "Completed", "progress" => 100, "budget" => "₹18,50,000", "updated" => "18 Jul 2026"],
    ["id" => "GP-1031", "name" => "Overhead Water Tank Repair", "category" => "Water Supply", "status" => "Ongoing", "progress" => 62, "budget" => "₹7,20,000", "updated" => "19 Jul 2026"],
    ["id" => "GP-1042", "name" => "Community Hall Construction", "category" => "Building", "status" => "Pending", "progress" => 8, "budget" => "₹24,80,000", "updated" => "15 Jul 2026"],
    ["id" => "GP-1050", "name" => "Drainage Line - Sector 5", "category" => "Sanitation", "status" => "Ongoing", "progress" => 45, "budget" => "₹9,60,000", "updated" => "20 Jul 2026"],
];

function statusBadgeClass($status) {
    switch ($status) {
        case "Completed": return "badge-success";
        case "Ongoing": return "badge-warning";
        case "Pending": return "badge-danger";
        default: return "";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Works | Ahmednagar Connect</title>
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
                <li class="active">
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

    <main class="main-content">
        <section class="welcome-card">
            <div>
                <h1>My Works, <?php echo htmlspecialchars($officerName); ?> <span>📋</span></h1>
                <p>Review all registered rural infrastructure works and their current status.</p>
            </div>
        </section>

        <section class="panel">
            <div class="section-header">
                <h2>Registered Works</h2>
                <a href="#" class="section-link">Export Report</a>
            </div>
            <div class="search-filter-row">
                <input type="text" class="form-control" placeholder="Search by work name or ID">
                <select class="form-control">
                    <option>All Status</option>
                    <option>Completed</option>
                    <option>Ongoing</option>
                    <option>Pending</option>
                </select>
            </div>
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Work ID</th>
                            <th>Work Name</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Progress</th>
                            <th>Budget</th>
                            <th>Last Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($works as $work): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($work['id']); ?></td>
                            <td><?php echo htmlspecialchars($work['name']); ?></td>
                            <td><?php echo htmlspecialchars($work['category']); ?></td>
                            <td><span class="badge <?php echo statusBadgeClass($work['status']); ?>"><?php echo htmlspecialchars($work['status']); ?></span></td>
                            <td>
                                <div class="progress-wrapper">
                                    <div class="progress-track">
                                        <div class="progress-fill" style="width: <?php echo (int)$work['progress']; ?>%;"></div>
                                    </div>
                                    <span class="progress-text"><?php echo (int)$work['progress']; ?>%</span>
                                </div>
                            </td>
                            <td><?php echo htmlspecialchars($work['budget']); ?></td>
                            <td><?php echo htmlspecialchars($work['updated']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>

<footer class="footer">
    <p>&copy; 2025 Ahmednagar Connect &nbsp;|&nbsp; Version 1.0</p>
</footer>

<script src="script.js"></script>
</body>
</html>
