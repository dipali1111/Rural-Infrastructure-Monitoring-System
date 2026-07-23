<?php
/**
 * Ahmednagar Connect - Rural Infrastructure Monitoring System
 * Module: New Work Registration
 * UI Only - No database, no backend logic, no authentication.
 */

$officerName = "Gram Panchayat Officer";

// Dummy dropdown data
$categories = ["Road", "Water Supply", "School", "Health", "Electricity"];
$fundingSchemes = [
    "MGNREGA",
    "15th Finance Commission Grant",
    "Jal Jeevan Mission",
    "State Rural Development Fund",
    "District Planning Committee Fund"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Work Registration | Ahmednagar Connect</title>

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
        <img src="logo.png.png" alt="Ahmednagar Connect Logo" class="topbar-logo">
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
                <li>
                    <a href="dashboard.php"><i class="fa-solid fa-house"></i><span>Dashboard</span></a>
                </li>
                <li class="active">
                    <a href="new_work.php"><i class="fa-solid fa-square-plus"></i><span>New Work Registration</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa-solid fa-clipboard-list"></i><span>My Works</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa-solid fa-chart-line"></i><span>Progress Update</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa-solid fa-camera"></i><span>Upload Photos</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa-solid fa-file-arrow-up"></i><span>Upload Documents</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa-solid fa-sack-dollar"></i><span>Financial Details</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa-solid fa-bullhorn"></i><span>Notifications</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa-solid fa-user"></i><span>Profile</span></a>
                </li>
                <li>
                    <a href="#"><i class="fa-solid fa-right-from-bracket"></i><span>Logout</span></a>
                </li>
            </ul>
        </nav>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ===================== MAIN CONTENT ===================== -->
    <main class="main-content">

        <!-- Page Header -->
        <section class="page-header">
            <div class="page-header-left">
                <div class="page-header-icon">
                    <i class="fa-solid fa-square-plus"></i>
                </div>
                <div>
                    <h1>New Work Registration</h1>
                    <p>Register a new rural infrastructure project under your Gram Panchayat.</p>
                </div>
            </div>
            <div class="breadcrumb">
                <a href="dashboard.php">Dashboard</a>
                <i class="fa-solid fa-chevron-right"></i>
                <span>New Work Registration</span>
            </div>
        </section>

        <!-- Registration Form -->
        <section class="form-section">

            <div class="info-note">
                <i class="fa-solid fa-circle-info"></i>
                <p>Please fill in all mandatory details accurately. Once submitted, the work will be reviewed and approved by the concerned authority before implementation begins.</p>
            </div>

            <form id="newWorkForm" autocomplete="off">

                <!-- Project Details -->
                <div class="form-subheading">
                    <i class="fa-solid fa-diagram-project"></i>
                    <span>Project Details</span>
                </div>

                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="projectName"><i class="fa-solid fa-signature"></i>Project Name <span class="required">*</span></label>
                        <input type="text" id="projectName" name="projectName" class="form-control" placeholder="Enter project name" required>
                    </div>

                    <div class="form-group">
                        <label for="projectCategory"><i class="fa-solid fa-layer-group"></i>Project Category <span class="required">*</span></label>
                        <select id="projectCategory" name="projectCategory" class="form-control" required>
                            <option value="" selected disabled>Select category</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo htmlspecialchars($cat); ?>"><?php echo htmlspecialchars($cat); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fundingScheme"><i class="fa-solid fa-hand-holding-dollar"></i>Funding Scheme <span class="required">*</span></label>
                        <select id="fundingScheme" name="fundingScheme" class="form-control" required>
                            <option value="" selected disabled>Select funding scheme</option>
                            <?php foreach ($fundingSchemes as $scheme): ?>
                                <option value="<?php echo htmlspecialchars($scheme); ?>"><?php echo htmlspecialchars($scheme); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="villageName"><i class="fa-solid fa-map-location-dot"></i>Village Name <span class="required">*</span></label>
                        <input type="text" id="villageName" name="villageName" class="form-control" placeholder="Enter village name" required>
                    </div>

                    <div class="form-group">
                        <label for="wardNumber"><i class="fa-solid fa-map-pin"></i>Ward Number <span class="required">*</span></label>
                        <input type="text" id="wardNumber" name="wardNumber" class="form-control" placeholder="e.g. Ward 3" required>
                    </div>

                    <div class="form-group">
                        <label for="estimatedCost"><i class="fa-solid fa-indian-rupee-sign"></i>Estimated Cost <span class="required">*</span></label>
                        <input type="number" id="estimatedCost" name="estimatedCost" class="form-control" placeholder="Enter amount in ₹" min="0" required>
                    </div>

                    <div class="form-group">
                        <label for="contractorName"><i class="fa-solid fa-user-tie"></i>Contractor Name</label>
                        <input type="text" id="contractorName" name="contractorName" class="form-control" placeholder="Enter contractor name">
                    </div>

                    <div class="form-group">
                        <label for="startDate"><i class="fa-solid fa-calendar-day"></i>Start Date <span class="required">*</span></label>
                        <input type="date" id="startDate" name="startDate" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="endDate"><i class="fa-solid fa-calendar-check"></i>Expected Completion Date <span class="required">*</span></label>
                        <input type="date" id="endDate" name="endDate" class="form-control" required>
                    </div>

                    <div class="form-group full-width">
                        <label for="projectDescription"><i class="fa-solid fa-align-left"></i>Project Description <span class="required">*</span></label>
                        <textarea id="projectDescription" name="projectDescription" class="form-control" placeholder="Describe the scope, purpose and expected outcome of the project" required></textarea>
                        <span class="form-hint">Provide a brief but clear description of the proposed work.</span>
                    </div>
                </div>

                <!-- Documents -->
                <div class="form-subheading">
                    <i class="fa-solid fa-file-shield"></i>
                    <span>Supporting Documents</span>
                </div>

                <div class="form-grid">
                    <div class="form-group full-width">
                        <label for="approvalLetter"><i class="fa-solid fa-file-arrow-up"></i>Upload Approval Letter <span class="required">*</span></label>
                        <div class="file-upload" id="fileUploadBox">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <span class="file-upload-title">Click to upload or drag and drop</span>
                            <span class="file-upload-sub">PDF, JPG or PNG (Max 5 MB)</span>
                            <input type="file" id="approvalLetter" name="approvalLetter" accept=".pdf,.jpg,.jpeg,.png" required>
                        </div>
                        <div class="file-name-preview" id="filePreview">
                            <i class="fa-solid fa-paperclip"></i>
                            <span id="fileNameText"></span>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="form-actions">
                    <button type="reset" class="btn btn-outline">
                        <i class="fa-solid fa-rotate-left"></i>
                        <span>Reset</span>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>Submit</span>
                    </button>
                </div>

            </form>
        </section>

    </main>
</div>

<!-- ===================== FOOTER ===================== -->
<footer class="footer">
    <p>&copy; 2025 Ahmednagar Connect &nbsp;|&nbsp; Version 1.0</p>
</footer>

<script src="script.js"></script>
<script>
    // File preview (UI only, no upload logic)
    document.addEventListener("DOMContentLoaded", function () {
        var fileInput = document.getElementById("approvalLetter");
        var filePreview = document.getElementById("filePreview");
        var fileNameText = document.getElementById("fileNameText");

        if (fileInput) {
            fileInput.addEventListener("change", function () {
                if (fileInput.files && fileInput.files.length > 0) {
                    fileNameText.textContent = fileInput.files[0].name;
                    filePreview.classList.add("show");
                } else {
                    filePreview.classList.remove("show");
                }
            });
        }

        // Prevent actual submission since this is UI only
        var form = document.getElementById("newWorkForm");
        if (form) {
            form.addEventListener("submit", function (e) {
                e.preventDefault();
                alert("Work registration submitted successfully. (UI demo only — no data is saved.)");
            });
        }
    });
</script>
</body>
</html>
