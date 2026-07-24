<?php
/**
 * reports.php — Reports & Analytics
 */
require_once 'includes/data.php';

$page_title = 'Reports & Analytics';
$breadcrumb = 'Reports';
$active     = 'reports';

include 'includes/header.php';
include 'includes/sidebar.php';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" defer></script>
<main class="ac-main-content">

    <div class="ac-breadcrumb">
        <a href="index.php" class="text-decoration-none" style="color:inherit;">Home</a> /
        <span class="current">Reports & Analytics</span>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="ac-page-title">Reports & Analytics</h1>
        <div>
            <button class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Generate Report</button>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body d-flex gap-3 align-items-center">
            <input class="form-control" placeholder="Search reports by name or type">
            <select class="form-select" style="max-width:180px;">
                <option selected>All Types</option>
                <option>PDF</option>
                <option>XLS</option>
            </select>
            <button class="btn btn-outline-secondary">Filter</button>
            <div class="ms-auto text-muted">Last updated: <strong><?php echo date('d M Y'); ?></strong></div>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><strong>Available Reports</strong></div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Report Name</th>
                        <th>Type</th>
                        <th>Size</th>
                        <th>Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reports as $r): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($r['name']); ?></td>
                        <td><?php echo htmlspecialchars($r['type']); ?></td>
                        <td><?php echo htmlspecialchars($r['size']); ?></td>
                        <td><?php echo htmlspecialchars($r['date']); ?></td>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-outline-secondary me-1"><i class="fa-solid fa-download"></i> Download</a>
                            <a href="#" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-eye"></i> View</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>

