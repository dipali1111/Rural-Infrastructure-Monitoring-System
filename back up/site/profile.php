<?php
/**
 * Ahmednagar Connect - Rural Infrastructure Monitoring System
 * Module: Profile
 */

$officerName = "Gram Panchayat Officer";
$officerRole = "Junior Engineer";
$contact = "+91 98765 43210";
$email = "officer@ahmadnagar.gov.in";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile | Ahmednagar Connect</title>
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
                <li>
                    <a href="notifications.php"><i class="fa-solid fa-bullhorn"></i><span>Notifications</span></a>
                </li>
                <li class="active">
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
                <h1>Officer Profile, <?php echo htmlspecialchars($officerName); ?> <span>👤</span></h1>
                <p>View and update your official profile information.</p>
            </div>
        </section>

        <section class="panel">
            <div class="section-header">
                <h2>Officer Details</h2>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($officerName); ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Designation</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($officerRole); ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($contact); ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($email); ?>" readonly>
                </div>
            </div>
        </section>

        <section class="panel">
            <div class="section-header">
                <h2>Edit Profile</h2>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" class="form-control" value="<?php echo htmlspecialchars($officerName); ?>">
                </div>
                <div class="form-group">
                    <label for="designation">Designation</label>
                    <input type="text" id="designation" class="form-control" value="<?php echo htmlspecialchars($officerRole); ?>">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" id="mobile" class="form-control" value="<?php echo htmlspecialchars($contact); ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary"><i class="fa-solid fa-save"></i> Save Changes</button>
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
