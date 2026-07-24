<?php
/**
 * gallery.php
 * Photo & document upload experience with a working file picker.
 */
require_once 'includes/data.php';

$page_title = 'Photo & Document Gallery';
$breadcrumb = 'Gallery';
$active = 'gallery';

include 'includes/header.php';
include 'includes/sidebar.php';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" defer></script>
<?php
?>
<main class="ac-main-content">
    <div class="ac-breadcrumb">
        <a href="index.php" class="text-decoration-none" style="color:inherit;">Home</a> /
        <span class="current">Gallery</span>
    </div>

    <div class="ac-page-title">Photo & Document Gallery</div>

    <div class="ac-card upload-panel">
        <div class="upload-actions">
            <button type="button" class="btn btn-primary upload-trigger" data-target="photoInput">
                <i class="bi bi-camera me-2"></i>Upload Photos
            </button>
            <button type="button" class="btn btn-outline-secondary upload-trigger" data-target="documentInput">
                <i class="bi bi-file-earmark-text me-2"></i>Upload Documents
            </button>
            <button type="button" class="btn btn-outline-primary" id="openDriveBtn">
                <i class="bi bi-cloud-arrow-up me-2"></i>Open Drive
            </button>
        </div>

        <input type="file" id="photoInput" accept="image/*" multiple hidden>
        <input type="file" id="documentInput" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt" multiple hidden>

        <div class="upload-help">
            Choose files from your device, or open Google Drive to upload them there.
        </div>

        <div id="uploadStatus" class="upload-status">No files selected yet.</div>
        <ul id="selectedFilesList" class="upload-file-list"></ul>
    </div>

    <div class="ac-card mt-4">
        <div class="ac-card-title">
            <i class="bi bi-images"></i>
            Recent uploads
        </div>
        <div class="row g-3">
            <?php foreach ($gallery as $item): ?>
            <div class="col-sm-6 col-lg-4">
                <div class="ac-gallery-item">
                    <div class="ac-gallery-thumb">
                        <i class="bi bi-image"></i>
                    </div>
                    <div class="ac-gallery-body">
                        <h6><?php echo htmlspecialchars($item['title']); ?></h6>
                        <span><?php echo htmlspecialchars($item['category']); ?> • <?php echo htmlspecialchars($item['date']); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
