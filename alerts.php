<?php
/**
 * alerts.php — Alerts & Notifications
 */
require_once 'includes/data.php';

$page_title = 'Alerts & Notifications';
$breadcrumb = 'Alerts';
$active     = 'alerts';

include 'includes/header.php';
include 'includes/sidebar.php';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" defer></script>
<main class="ac-main-content">

    <div class="ac-breadcrumb">
        <a href="index.php" class="text-decoration-none" style="color:inherit;">Home</a> /
        <span class="current">Alerts & Notifications</span>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="ac-page-title">Alerts & Notifications</h1>
        <div>
            <button class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-bell-slash"></i> Clear All</button>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <?php foreach ($alerts as $al): ?>
        <div class="col-md-6">
            <div class="card border-<?php echo htmlspecialchars($al['color']); ?>">
                <div class="card-body d-flex">
                    <div class="me-3 align-self-start"><i class="bi <?php echo $al['icon']; ?> fa-2x text-<?php echo $al['color']; ?>"></i></div>
                    <div>
                        <h6 class="mb-1"><?php echo htmlspecialchars($al['type']); ?></h6>
                        <div class="small text-muted"><?php echo htmlspecialchars($al['desc']); ?></div>
                        <div class="small text-muted mt-2"><?php echo htmlspecialchars($al['time']); ?></div>
                    </div>
                    <div class="ms-auto">
                        <button class="btn btn-sm btn-outline-primary">Acknowledge</button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="card">
        <div class="card-header"><strong>All Alerts</strong></div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Type</th>
                        <th>Description</th>
                        <th>When</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alerts as $al): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($al['type']); ?></td>
                        <td><?php echo htmlspecialchars($al['desc']); ?></td>
                        <td class="small text-muted"><?php echo htmlspecialchars($al['time']); ?></td>
                        <td class="text-end"><a href="#" class="btn btn-sm btn-outline-secondary">View</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>

