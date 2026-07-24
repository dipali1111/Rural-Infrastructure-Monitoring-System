<?php
/**
 * verifications.php — Pending Verifications
 * Frontend-only demo page. Dummy data from includes/data.php.
 */
require_once 'includes/data.php';

$page_title = 'Pending Verifications';
$active     = 'verifications';

include 'includes/header.php';
include 'includes/sidebar.php';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" defer></script>
<main class="ac-main-content">

    <div class="ac-breadcrumb">
        <a href="index.php" class="text-decoration-none" style="color:inherit;">Home</a> / <span class="current">Pending Verifications</span>
    </div>
    <h1 class="ac-page-title">Pending Verifications</h1>

    <div class="mb-3 d-flex justify-content-between align-items-center">
        <div class="d-flex gap-2">
            <input class="form-control form-control-sm" placeholder="Search by verification id or project">
            <select class="form-select form-select-sm">
                <option selected>All Statuses</option>
                <option>Pending</option>
                <option>Under Review</option>
                <option>Completed</option>
            </select>
        </div>
        <div>
            <button class="btn btn-sm btn-primary"><i class="fa-solid fa-check"></i> Bulk Approve</button>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Verification ID</th>
                        <th>Project</th>
                        <th>Submitted On</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($verifications as $v): ?>
                    <tr>
                        <td class="fw-semibold text-primary"><?php echo htmlspecialchars($v['id']); ?></td>
                        <td><?php echo htmlspecialchars($v['project']); ?></td>
                        <td><?php echo htmlspecialchars($v['submitted']); ?></td>
                        <td><span class="badge <?php echo status_badge_class($v['status']); ?>"><?php echo htmlspecialchars($v['status']); ?></span></td>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-success me-1" title="Approve"><i class="fa-solid fa-check"></i></a>
                            <a href="#" class="btn btn-sm btn-outline-secondary" title="View"><i class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>
