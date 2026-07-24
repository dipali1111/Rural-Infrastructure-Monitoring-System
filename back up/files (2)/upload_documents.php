<?php
/**
 * Ahmednagar Connect - Rural Infrastructure Monitoring System
 * Module: Upload Documents
 */

$officerName = "Gram Panchayat Officer";

$documents = [
    ["name" => "Approval Letter - GP-1031.pdf", "type" => "PDF", "date" => "19 Jul 2026"],
    ["name" => "Estimate Sheet - GP-1042.docx", "type" => "DOC", "date" => "15 Jul 2026"],
    ["name" => "Measurement Report - GP-1050.pdf", "type" => "PDF", "date" => "12 Jul 2026"],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Upload Documents | Ahmednagar Connect</title>
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
                <li class="active">
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
                <h1>Upload Documents, <?php echo htmlspecialchars($officerName); ?> <span>📄</span></h1>
                <p>Submit permits, estimates, and supporting records for government works.</p>
            </div>
        </section>

        <section class="panel">
            <div class="section-header">
                <h2>Upload New Document</h2>
            </div>
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="docTitle">Document Title</label>
                    <input type="text" id="docTitle" class="form-control" placeholder="e.g. Final Estimate Report">
                </div>
                <div class="form-group full-width">
                    <label for="docFile">Choose File</label>
                    <div class="file-upload">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <span class="file-upload-title">Click to upload PDF or DOC</span>
                        <span class="file-upload-sub">PDF, DOC, DOCX</span>
                        <input type="file" id="docFile" accept=".pdf,.doc,.docx">
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i> Upload</button>
                </div>
            </div>
        </section>

        <section class="panel">
            <div class="section-header">
                <h2>Uploaded Documents</h2>
            </div>
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Document Name</th>
                            <th>Type</th>
                            <th>Uploaded On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($documents as $doc): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($doc['name']); ?></td>
                            <td><?php echo htmlspecialchars($doc['type']); ?></td>
                            <td><?php echo htmlspecialchars($doc['date']); ?></td>
                            <td><a href="#" class="section-link">View</a></td>
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
