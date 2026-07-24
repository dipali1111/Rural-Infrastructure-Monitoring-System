<?php
/**
 * settings.php — Application settings placeholder
 */
require_once 'includes/data.php';

$page_title = 'Settings';
$breadcrumb = 'Settings';
$active     = 'settings';

include 'includes/header.php';
include 'includes/sidebar.php';
?>
<main class="ac-main-content">

    <div class="ac-breadcrumb">
        <a href="index.php" class="text-decoration-none" style="color:inherit;">Home</a> /
        <span class="current">Settings</span>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="ac-page-title">Settings</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="post" action="#">
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Language</label>
                    <div class="col-sm-9">
                        <select class="form-select" name="language">
                            <option value="en">English</option>
                            <option value="mr">मराठी (Marathi)</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Notifications</label>
                    <div class="col-sm-9">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="notifyToggle" checked>
                            <label class="form-check-label" for="notifyToggle">Enable notifications</label>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary">Save Settings</button>
                </div>
            </form>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>
