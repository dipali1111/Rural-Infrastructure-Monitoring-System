<?php
/**
 * Ahmednagar Connect - Rural Infrastructure Monitoring System
 * Module: Upload Photos
 */

$officerName = "Gram Panchayat Officer";

$photos = [
    ["title_en" => "Ward 3 Road Site", "title_mr" => "वार्ड ३ रस्ता साइट", "date_en" => "21 Jul 2026", "date_mr" => "२१ जुलै २०२६", "img" => "https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=800&q=80"],
    ["title_en" => "Water Tank Repair", "title_mr" => "पाणी टँक दुरुस्ती", "date_en" => "19 Jul 2026", "date_mr" => "१९ जुलै २०२६", "img" => "https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=800&q=80"],
    ["title_en" => "Drainage Work", "title_mr" => "सांडपाणी काम", "date_en" => "17 Jul 2026", "date_mr" => "१७ जुलै २०२६", "img" => "https://images.unsplash.com/photo-1517048676732-d65bc937f337?auto=format&fit=crop&w=800&q=80"],
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
.file-upload {
    border: 2px dashed #8fb4c8;
    border-radius: 16px;
    padding: 24px;
    text-align: center;
    background: #f8fbfe;
    cursor: pointer;
}
.file-upload i { font-size: 28px; color: #1d6f9e; margin-bottom: 10px; display: block; }
.file-upload-title, .file-upload-sub { display: block; margin-top: 6px; color: #35556b; }
.file-upload-sub { color: #6d8497; font-size: 0.92rem; }
.preview-box { display: none; margin-top: 18px; border: 1px solid #dce9f2; border-radius: 14px; padding: 12px; background: #fff; }
.preview-box img { width: 100%; max-height: 220px; object-fit: cover; border-radius: 10px; }
.preview-caption { margin-top: 10px; color: #35556b; }
.lang-link.lang-active { color: #1d6f9e; font-weight: 700; }
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
        <button class="icon-btn" data-en-title="Notifications" data-mr-title="सूचना" title="Notifications">
            <i class="fa-regular fa-bell"></i>
            <span class="icon-dot"></span>
        </button>
        <button class="icon-btn" data-en-title="Profile" data-mr-title="प्रोफाइल" title="Profile">
            <i class="fa-regular fa-circle-user"></i>
        </button>
        <button class="logout-btn" data-en-title="Logout" data-mr-title="बाहेर पडा" title="Logout">
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
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="photoTitle" data-en="Photo Title" data-mr="फोटो शीर्षक">Photo Title</label>
                    <input type="text" id="photoTitle" class="form-control" data-en-placeholder="e.g. Road work progress at Ward 3" data-mr-placeholder="उदा. वार्ड ३ मधील रस्ता कामाची प्रगती" placeholder="e.g. Road work progress at Ward 3">
                </div>
                <div class="form-group full-width">
                    <label for="photoFile" data-en="Take or choose image" data-mr="चित्र घेणे किंवा निवडणे">Take or choose image</label>
                    <div class="file-upload" id="photoUploadBox">
                        <i class="fa-solid fa-camera"></i>
                        <span class="file-upload-title" data-en="Tap to open the real camera or choose a photo" data-mr="खरं कॅमेरा उघडण्यासाठी किंवा फोटो निवडण्यासाठी टॅप करा">Tap to open the real camera or choose a photo</span>
                        <span class="file-upload-sub" data-en="JPG, JPEG, PNG, WEBP" data-mr="JPG, JPEG, PNG, WEBP">JPG, JPEG, PNG, WEBP</span>
                        <button type="button" class="btn btn-primary" id="cameraBtn" style="margin-top:12px;" data-en="Open Camera / Choose Photo" data-mr="कॅमेरा उघडा / फोटो निवडा">Open Camera / Choose Photo</button>
                        <input type="file" id="photoFile" accept="image/*" capture="environment" hidden>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" data-en="Upload" data-mr="अपलोड करा">Upload</button>
                </div>
            </div>

            <div class="preview-box" id="previewBox">
                <img id="previewImage" src="" alt="preview">
                <div class="preview-caption" id="previewCaption" data-en="Selected image ready to upload" data-mr="अपलोडसाठी निवडलेले चित्र तयार आहे">Selected image ready to upload</div>
            </div>
        </section>

    </main>
</div>

<footer class="footer">
    <p>&copy; 2025 Ahmednagar Connect &nbsp;|&nbsp; Version 1.0</p>
</footer>

<script src="script.js"></script>
<script>
function updateLanguage(lang) {
    document.documentElement.lang = lang === 'mr' ? 'mr' : 'en';
    document.body.dataset.lang = lang;

    document.querySelectorAll('[data-en][data-mr]').forEach(function (el) {
        var textValue = lang === 'mr' ? el.getAttribute('data-mr') : el.getAttribute('data-en');
        if (el.tagName.toLowerCase() === 'title') {
            document.title = textValue;
            el.textContent = textValue;
        } else {
            el.textContent = textValue;
        }
    });

    document.querySelectorAll('[data-en-title][data-mr-title]').forEach(function (el) {
        el.title = lang === 'mr' ? el.getAttribute('data-mr-title') : el.getAttribute('data-en-title');
    });

    document.querySelectorAll('[data-en-placeholder][data-mr-placeholder]').forEach(function (el) {
        el.placeholder = lang === 'mr' ? el.getAttribute('data-mr-placeholder') : el.getAttribute('data-en-placeholder');
    });

    document.querySelectorAll('.lang-link').forEach(function (link) {
        link.classList.toggle('lang-active', link.getAttribute('data-lang') === lang);
    });
}

function initCameraUpload() {
    const input = document.getElementById('photoFile');
    const button = document.getElementById('cameraBtn');
    const previewBox = document.getElementById('previewBox');
    const previewImage = document.getElementById('previewImage');
    const previewCaption = document.getElementById('previewCaption');

    if (!input || !button) return;

    button.addEventListener('click', function () {
        input.click();
    });

    input.addEventListener('change', function () {
        const file = input.files && input.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function (event) {
            previewImage.src = event.target.result;
            previewBox.style.display = 'block';
            previewCaption.textContent = document.body.dataset.lang === 'mr' ? 'निवडलेले चित्र अपलोडसाठी तयार आहे' : 'Selected image ready to upload';
        };
        reader.readAsDataURL(file);
    });
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.lang-link').forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            updateLanguage(link.getAttribute('data-lang'));
        });
    });
    initCameraUpload();
    updateLanguage('en');
});
</script>
</body>
</html>
