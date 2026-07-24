<?php
/**
 * profile.php — User profile placeholder
 */
require_once 'includes/data.php';

$page_title = 'My Profile';
$breadcrumb = 'Profile';
$active     = 'profile';

include 'includes/header.php';
include 'includes/sidebar.php';
?>
<main class="ac-main-content">

    <div class="ac-breadcrumb">
        <a href="index.php" class="text-decoration-none" style="color:inherit;">Home</a> /
        <span class="current">Profile</span>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="ac-page-title">My Profile</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 text-center">
                    <img src="assets/images/logo.png" class="rounded-circle" alt="Profile" style="width:120px;">
                </div>
                <div class="col-md-9">
                    <h4><?php echo htmlspecialchars(t('profile_name')); ?></h4>
                    <p class="text-muted"><?php echo htmlspecialchars(t('profile_role')); ?></p>
                    <dl class="row">
                        <dt class="col-sm-3">Email</dt>
                        <dd class="col-sm-9">admin@example.com</dd>

                        <dt class="col-sm-3">Phone</dt>
                        <dd class="col-sm-9">+91-xxxxxxxxxx</dd>

                        <dt class="col-sm-3">Organization</dt>
                        <dd class="col-sm-9">Ahmednagar Connect</dd>
                    </dl>
                    <a href="settings.php" class="btn btn-outline-primary">Edit Profile / Settings</a>
                </div>
            </div>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>
