<?php
/**
 * Ahmednagar Connect - Rural Infrastructure Monitoring System
 * Module: Financial Details
 */

$officerName = "Gram Panchayat Officer";

$budgetCards = [
    ["title" => "Approved Budget", "value" => "₹3.42 Cr", "note" => "Current fiscal year"],
    ["title" => "Spent So Far", "value" => "₹1.89 Cr", "note" => "Utilization till date"],
    ["title" => "Balance", "value" => "₹1.53 Cr", "note" => "Remaining funds"],
];

$expenditure = [
    ["work" => "Ward 3 Road Work", "head" => "Construction", "amount" => "₹42,00,000", "status" => "Approved"],
    ["work" => "Water Tank Repair", "head" => "Materials", "amount" => "₹12,50,000", "status" => "Pending"],
    ["work" => "Community Hall", "head" => "Labour", "amount" => "₹18,20,000", "status" => "Approved"],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Financial Details | Ahmednagar Connect</title>
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
                <li class="active">
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
                <h1>Financial Details, <?php echo htmlspecialchars($officerName); ?> <span>💰</span></h1>
                <p>Monitor budget allocation, expenditure, and fund utilization.</p>
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
                <h2>Expenditure Summary</h2>
            </div>
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Work</th>
                            <th>Budget Head</th>
                            <th>Amount</th>
                            <th>Status</th>
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
    <p>&copy; 2025 Ahmednagar Connect &nbsp;|&nbsp; Version 1.0</p>
</footer>

<script src="script.js"></script>
</body>
</html>
