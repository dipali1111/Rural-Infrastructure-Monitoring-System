<?php
/**
 * Ahmednagar Connect - Rural Infrastructure Monitoring System
 * Module: New Work Registration
 */

$officerName = "Gram Panchayat Officer";
$categories = ["Road", "Water Supply", "School", "Health", "Electricity"];
$fundingSchemes = ["MGNREGA", "15th Finance Commission Grant", "Jal Jeevan Mission", "State Rural Development Fund"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Work Registration | Ahmednagar Connect</title>
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
                <li class="active">
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

    <main class="main-content">
        <section class="welcome-card">
            <div>
                <h1>New Work Registration, <?php echo htmlspecialchars($officerName); ?> <span>📝</span></h1>
                <p>Register a new rural infrastructure project under your Gram Panchayat.</p>
            </div>
        </section>

        <section class="panel">
            <div class="section-header">
                <h2>Work Registration Form</h2>
            </div>
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="projectName">Project Name</label>
                    <input type="text" id="projectName" class="form-control" placeholder="Enter project name">
                </div>
                <div class="form-group">
                    <label for="projectCategory">Category</label>
                    <select id="projectCategory" class="form-control">
                        <option value="">Select category</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo htmlspecialchars($cat); ?>"><?php echo htmlspecialchars($cat); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fundingScheme">Funding Scheme</label>
                    <select id="fundingScheme" class="form-control">
                        <option value="">Select scheme</option>
                        <?php foreach ($fundingSchemes as $scheme): ?>
                            <option value="<?php echo htmlspecialchars($scheme); ?>"><?php echo htmlspecialchars($scheme); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="villageName">Village Name</label>
                    <input type="text" id="villageName" class="form-control" placeholder="Enter village name">
                </div>
                <div class="form-group">
                    <label for="wardNumber">Ward Number</label>
                    <input type="text" id="wardNumber" class="form-control" placeholder="Ward 3">
                </div>
                <div class="form-group">
                    <label for="estimatedCost">Estimated Cost</label>
                    <input type="number" id="estimatedCost" class="form-control" placeholder="₹">
                </div>
                <div class="form-group full-width">
                    <label for="description">Project Description</label>
                    <textarea id="description" class="form-control" placeholder="Describe the project details"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i> Submit</button>
                </div>
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
