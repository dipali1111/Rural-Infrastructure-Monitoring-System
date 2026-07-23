<?php
/**
 * Ahmednagar Connect - Rural Infrastructure Monitoring System
 * Module: Upload Photos
 */

$officerName = "Gram Panchayat Officer";

$photos = [
    ["title_en" => "Ward 3 Road Site", "title_mr" => "वार्ड ३ रस्ता साइट", "date_en" => "21 Jul 2026", "date_mr" => "२१ जुलै २०२६", "img" => "https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=800&q=80", "project_en" => "Ward 3 Road Work", "project_mr" => "वार्ड ३ रस्ता काम"],
    ["title_en" => "Water Tank Repair", "title_mr" => "पाणी टँक दुरुस्ती", "date_en" => "19 Jul 2026", "date_mr" => "१९ जुलै २०२६", "img" => "https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=800&q=80", "project_en" => "Water Supply Project", "project_mr" => "पाणीपुरवठा प्रकल्प"],
    ["title_en" => "Drainage Work", "title_mr" => "सांडपाणी काम", "date_en" => "17 Jul 2026", "date_mr" => "१७ जुलै २०२६", "img" => "https://images.unsplash.com/photo-1517048676732-d65bc937f337?auto=format&fit=crop&w=800&q=80", "project_en" => "Sanitation Upgrade", "project_mr" => "स्वच्छता सुधार"],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title data-en="Upload Photos | Ahmednagar Connect" data-mr="फोटो अपलोड | अहमदनगर कनेक्ट">Upload Photos | Ahmednagar Connect</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="style.css">
<style>
.upload-card {
    background: #ffffff;
    border: 1px solid #d9e4ed;
    border-radius: 18px;
    padding: 28px;
    box-shadow: 0 14px 30px rgba(23, 67, 102, 0.05);
}
.upload-dropzone {
    border: 2px dashed #92b6ca;
    border-radius: 18px;
    padding: 34px 28px;
    text-align: center;
    cursor: pointer;
    transition: background 0.25s ease, border-color 0.25s ease;
}
.upload-dropzone.dragover {
    background: rgba(32, 113, 165, 0.06);
    border-color: #1d7fb5;
}
.upload-icon {
    width: 72px;
    height: 72px;
    margin: 0 auto 18px;
    border-radius: 50%;
    background: rgba(29, 86, 124, 0.12);
    color: #1b628f;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
}
.upload-dropzone strong {
    display: block;
    font-size: 1.05rem;
    margin-bottom: 8px;
    color: #163b55;
}
.upload-dropzone p {
    color: #5e7a96;
    margin-bottom: 20px;
}
.upload-dropzone .btn {
    min-width: 210px;
}
.upload-preview {
    display: grid;
    grid-template-columns: 150px 1fr auto;
    gap: 20px;
    margin-top: 24px;
    align-items: center;
    border-top: 1px solid #ebf1f6;
    padding-top: 24px;
}
.upload-preview img {
    width: 150px;
    height: 120px;
    object-fit: cover;
    border-radius: 14px;
    border: 1px solid #d9e4ed;
}
.preview-details {
    color: #1d3d55;
}
.preview-details strong {
    display: block;
    margin-bottom: 8px;
    font-size: 1rem;
}
.preview-details small {
    display: block;
    margin-bottom: 6px;
    color: #5d728a;
}
.upload-status {
    margin-top: 22px;
}
.progress-bar {
    height: 10px;
    background: #e6f1f8;
    border-radius: 8px;
    overflow: hidden;
}
.progress-fill {
    width: 0;
    height: 100%;
    background: linear-gradient(90deg, #1e79b8, #51c2ff);
    transition: width 0.2s ease;
}
.progress-loader {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 10px;
    font-size: 0.95rem;
    color: #1e3d57;
}
.spinner {
    width: 16px;
    height: 16px;
    border: 2px solid #d8e8f2;
    border-top-color: #1e79b8;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}
.progress-text {
    margin-top: 12px;
    font-weight: 600;
    color: #1e3d57;
}
.upload-message {
    margin-top: 18px;
    padding: 14px 16px;
    border-radius: 14px;
    background: #e9fbef;
    color: #0f6d35;
    border: 1px solid #b8e5c4;
    display: none;
}
.lang-link.lang-active { color: #1d6f9e; font-weight: 700; }
@keyframes spin {
    to { transform: rotate(360deg); }
}
@media (max-width: 760px) {
    .upload-preview {
        grid-template-columns: 1fr;
    }
    .upload-preview img {
        width: 100%;
        height: 180px;
    }
}
</style>
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
            <span class="topbar-title-sub" data-en="Gram Panchayat Dashboard" data-mr="ग्रामपंचायत डॅशबोर्ड">Gram Panchayat Dashboard</span>
        </div>
    </div>
    <div class="topbar-center"></div>
    <div class="topbar-right">
        <div class="lang-switch">
            <a href="#" class="lang-link lang-active" data-lang="en" data-en="English" data-mr="इंग्रजी">English</a>
            <span class="lang-sep">|</span>
            <a href="#" class="lang-link" data-lang="mr" data-en="मराठी" data-mr="मराठी">मराठी</a>
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
            <span data-en="Logout" data-mr="बाहेर पडा">Logout</span>
        </button>
    </div>
</header>

<div class="app-body">
    <aside class="sidebar" id="sidebar">
        <nav class="sidebar-nav">
            <ul>
                <li>
                    <a href="dashboard.php"><i class="fa-solid fa-house"></i><span class="nav-label" data-en="Dashboard" data-mr="डॅशबोर्ड">Dashboard</span></a>
                </li>
                <li>
                    <a href="new_work.php"><i class="fa-solid fa-square-plus"></i><span class="nav-label" data-en="New Work Registration" data-mr="नवीन काम नोंदणी">New Work Registration</span></a>
                </li>
                <li>
                    <a href="my_works.php"><i class="fa-solid fa-clipboard-list"></i><span class="nav-label" data-en="My Works" data-mr="माझे काम">My Works</span></a>
                </li>
                <li>
                    <a href="progress_update.php"><i class="fa-solid fa-chart-line"></i><span class="nav-label" data-en="Progress Update" data-mr="प्रगती अद्यतन">Progress Update</span></a>
                </li>
                <li class="active">
                    <a href="upload_photos.php"><i class="fa-solid fa-camera"></i><span class="nav-label" data-en="Upload Photos" data-mr="फोटो अपलोड">Upload Photos</span></a>
                </li>
                <li>
                    <a href="upload_documents.php"><i class="fa-solid fa-file-arrow-up"></i><span class="nav-label" data-en="Upload Documents" data-mr="दस्तऐवज अपलोड">Upload Documents</span></a>
                </li>
                <li>
                    <a href="financial_details.php"><i class="fa-solid fa-sack-dollar"></i><span class="nav-label" data-en="Financial Details" data-mr="आर्थिक तपशील">Financial Details</span></a>
                </li>
                <li>
                    <a href="notifications.php"><i class="fa-solid fa-bullhorn"></i><span class="nav-label" data-en="Notifications" data-mr="सूचना">Notifications</span></a>
                </li>
                <li>
                    <a href="profile.php"><i class="fa-solid fa-user"></i><span class="nav-label" data-en="Profile" data-mr="प्रोफाइल">Profile</span></a>
                </li>
                <li>
                    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i><span class="nav-label" data-en="Logout" data-mr="बाहेर पडा">Logout</span></a>
                </li>
            </ul>
        </nav>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <main class="main-content">
        <section class="welcome-card">
            <div>
                <h1 data-en="Upload Photos, Gram Panchayat Officer" data-mr="फोटो अपलोड करा, ग्रामपंचायत अधिकारी">Upload Photos, <?php echo htmlspecialchars($officerName); ?> <span>📷</span></h1>
                <p data-en="Upload site photographs for verification and public progress tracking." data-mr="सत्यापन आणि सार्वजनिक प्रगती ट्रॅकिंगसाठी साइटची फोटो अपलोड करा.">Upload site photographs for verification and public progress tracking.</p>
            </div>
        </section>

        <section class="panel">
            <div class="section-header">
                <h2 data-en="Upload New Photo" data-mr="नवीन फोटो अपलोड करा">Upload New Photo</h2>
            </div>
            <div class="upload-card">
                <div class="upload-dropzone" id="uploadDropzone">
                    <div class="upload-icon">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                    <strong data-en="Click or tap to open the real camera" data-mr="खरं कॅमेरा उघडण्यासाठी क्लिक किंवा टॅप करा">Click or tap to open the real camera</strong>
                    <p data-en="Supports JPG, JPEG, PNG, WEBP" data-mr="JPG, JPEG, PNG, WEBP समर्थन करते">Supports JPG, JPEG, PNG, WEBP</p>
                    <button type="button" class="btn btn-primary" id="uploadSelectBtn">
                        <i class="fa-solid fa-camera"></i> <span data-en="Open Camera / Choose Photo" data-mr="कॅमेरा उघडा / फोटो निवडा">Open Camera / Choose Photo</span>
                    </button>
                    <input type="file" id="photoFile" accept="image/*" capture="environment" hidden>
                </div>

                <div class="upload-preview" id="uploadPreview" style="display:none;">
                    <img id="previewImage" src="" alt="Photo preview">
                    <div class="preview-details">
                        <strong id="previewName" data-en="Selected photo preview" data-mr="निवडलेला फोटो पूर्वावलोकन">Selected photo preview</strong>
                        <small id="previewSize" data-en="Ready to upload" data-mr="अपलोड करण्यासाठी तयार">Ready to upload</small>
                        <small id="previewProject" data-en="Project: Gram Panchayat Field Photo" data-mr="प्रकल्प: ग्रामपंचायत फील्ड फोटो">Project: Gram Panchayat Field Photo</small>
                        <small id="previewDate" data-en="Date: Today" data-mr="तारीख: आज">Date: Today</small>
                    </div>
                    <button type="button" class="btn btn-primary" id="uploadBtn" disabled>
                        <i class="fa-solid fa-upload"></i> <span data-en="Upload" data-mr="अपलोड करा">Upload</span>
                    </button>
                </div>
                <div class="upload-status" id="uploadStatus" style="display:none;">
                    <div class="progress-bar">
                        <div class="progress-fill" id="progressFill"></div>
                    </div>
                    <div class="progress-loader" id="progressLoader">
                        <span class="spinner"></span>
                        <span data-en="Uploading photo..." data-mr="फोटो अपलोड करत आहे...">Uploading photo...</span>
                    </div>
                    <div class="progress-text" id="progressText">0%</div>
                </div>
                <div class="upload-message" id="uploadMessage"></div>
            </div>
        </section>

    </main>
</div>

<footer class="footer">
    <p>&copy; 2025 Ahmednagar Connect &nbsp;|&nbsp; Version 1.0</p>
</footer>

<script>
(function() {
    var fileInput = document.getElementById('photoFile');
    var dropzone = document.getElementById('uploadDropzone');
    var selectBtn = document.getElementById('uploadSelectBtn');
    var previewSection = document.getElementById('uploadPreview');
    var previewImage = document.getElementById('previewImage');
    var previewName = document.getElementById('previewName');
    var previewSize = document.getElementById('previewSize');
    var previewProject = document.getElementById('previewProject');
    var previewDate = document.getElementById('previewDate');
    var uploadBtn = document.getElementById('uploadBtn');
    var uploadStatus = document.getElementById('uploadStatus');
    var progressFill = document.getElementById('progressFill');
    var progressText = document.getElementById('progressText');
    var progressLoader = document.getElementById('progressLoader');
    var uploadMessage = document.getElementById('uploadMessage');
    var recentPhotos = document.getElementById('recentPhotos');
    var selectedFile = null;

    function formatBytes(bytes) {
        if (bytes === 0) return '0 B';
        var sizes = ['B', 'KB', 'MB', 'GB'];
        var i = Math.floor(Math.log(bytes) / Math.log(1024));
        return parseFloat((bytes / Math.pow(1024, i)).toFixed(1)) + ' ' + sizes[i];
    }

    function updatePreview(file) {
        if (!file) return;
        selectedFile = file;
        var reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
        };
        reader.readAsDataURL(file);
        previewName.textContent = file.name;
        previewSize.textContent = document.body.dataset.lang === 'mr' ? 'अपलोड करण्यासाठी तयार' : 'Ready to upload';
        previewProject.textContent = document.body.dataset.lang === 'mr' ? 'प्रकल्प: ग्रामपंचायत फील्ड फोटो' : 'Project: Gram Panchayat Field Photo';
        previewDate.textContent = document.body.dataset.lang === 'mr' ? 'तारीख: आज' : 'Date: Today';
        previewSection.style.display = 'grid';
        uploadBtn.disabled = false;
        uploadStatus.style.display = 'none';
        progressFill.style.width = '0%';
        progressText.textContent = '0%';
        uploadMessage.style.display = 'none';
    }

    function handleFiles(files) {
        if (!files || !files.length) return;
        var file = files[0];
        if (!file.type.match('image.*')) return;
        updatePreview(file);
    }

    selectBtn.addEventListener('click', function() {
        fileInput.click();
    });

    dropzone.addEventListener('click', function() {
        fileInput.click();
    });

    dropzone.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropzone.classList.add('dragover');
    });

    dropzone.addEventListener('dragleave', function() {
        dropzone.classList.remove('dragover');
    });

    dropzone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropzone.classList.remove('dragover');
        handleFiles(e.dataTransfer.files);
    });

    fileInput.addEventListener('change', function() {
        handleFiles(fileInput.files);
    });

    uploadBtn.addEventListener('click', function() {
        if (!selectedFile) return;
        uploadBtn.disabled = true;
        uploadStatus.style.display = 'block';
        progressLoader.style.display = 'flex';
        uploadMessage.style.display = 'none';
        var progress = 0;
        var interval = setInterval(function() {
            progress += Math.floor(Math.random() * 18) + 12;
            if (progress >= 100) progress = 100;
            progressFill.style.width = progress + '%';
            progressText.textContent = progress + '%';
            if (progress === 100) {
                clearInterval(interval);
                progressLoader.style.display = 'none';
                uploadBtn.disabled = false;
                uploadMessage.textContent = document.body.dataset.lang === 'mr' ? 'फोटो यशस्वीपणे अपलोड झाला.' : 'Photo uploaded successfully.';
                uploadMessage.style.display = 'block';
                addUploadedPhotoCard(selectedFile, previewImage.src, previewProject.textContent.replace('Project: ', ''), previewDate.textContent.replace('Date: ', ''));
            }
        }, 220);
    });

    function addUploadedPhotoCard(file, src, projectName, uploadDate) {
        var title = file.name.replace(/\.[^/.]+$/, '');
        var card = document.createElement('div');
        card.className = 'stat-card';
        card.innerHTML = '<img src="' + src + '" alt="' + title + '" style="width:100%; height:140px; object-fit:cover; border-radius:10px; margin-bottom:12px;">' +
            '<div class="stat-info">' +
                '<span class="stat-label">' + title + '</span>' +
                '<small>' + uploadDate + '</small>' +
                '<small style="display:block; margin-top:6px; color:#5e758f;">' + projectName + '</small>' +
            '</div>';
        recentPhotos.insertBefore(card, recentPhotos.firstChild);
    }
})();

function updateLanguage(lang) {
    document.documentElement.lang = lang === 'mr' ? 'mr' : 'en';
    document.body.dataset.lang = lang;
    document.querySelectorAll('[data-en][data-mr]').forEach(function(el) {
        el.textContent = lang === 'mr' ? el.getAttribute('data-mr') : el.getAttribute('data-en');
    });
    document.querySelectorAll('.lang-link').forEach(function(link) {
        link.classList.toggle('lang-active', link.getAttribute('data-lang') === lang);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.lang-link').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            updateLanguage(link.getAttribute('data-lang'));
        });
    });
    updateLanguage('en');
});
</script>

<script src="script.js"></script>
</body>
</html>