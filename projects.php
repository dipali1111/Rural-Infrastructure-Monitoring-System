<?php
/**
 * projects.php — Project / Work Master
 */
require_once 'includes/data.php';

$page_title = 'Projects';
$breadcrumb = 'Projects';
$active     = 'projects';

include 'includes/header.php';
include 'includes/sidebar.php';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" defer></script>
<main class="ac-main-content">

    <div class="ac-breadcrumb">
        <a href="index.php" class="text-decoration-none" style="color:inherit;">Home</a> /
        <span class="current">Project / Work Master</span>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="ac-page-title">Project / Work Master</h1>
        <div>
            <a href="projects.php?action=add" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Add Project</a>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-3">
            <div class="card p-3 text-center">
                <div class="h5 mb-0"><?php echo count($projects); ?></div>
                <small class="text-muted">Total Projects</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 text-center">
                <div class="h5 mb-0"><?php echo array_sum(array_map(fn($p)=>$p['status'] === 'Completed' ? 1 : 0, $projects)); ?></div>
                <small class="text-muted">Completed</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 text-center">
                <div class="h5 mb-0"><?php echo array_sum(array_map(fn($p)=>$p['status'] === 'In Progress' ? 1 : 0, $projects)); ?></div>
                <small class="text-muted">In Progress</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 text-center">
                <div class="h5 mb-0"><?php echo array_sum(array_map(fn($p)=>$p['status'] === 'Pending' ? 1 : 0, $projects)); ?></div>
                <small class="text-muted">Pending</small>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>All Projects</strong>
            <div class="d-flex gap-2">
                <input class="form-control form-control-sm" placeholder="Search by project id, village or category">
                <select class="form-select form-select-sm">
                    <option selected>All Statuses</option>
                    <option>Completed</option>
                    <option>In Progress</option>
                    <option>Pending</option>
                    <option>Delayed</option>
                </select>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Project ID</th>
                        <th>Village</th>
                        <th>Category</th>
                        <th>Budget</th>
                        <th>Status</th>
                        <th>Updated</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects as $p): ?>
                    <tr>
                        <td class="fw-bold"><?php echo htmlspecialchars($p['id']); ?></td>
                        <td><?php echo htmlspecialchars($p['village']); ?></td>
                        <td><?php echo htmlspecialchars($p['category']); ?></td>
                        <td><?php echo htmlspecialchars($p['budget']); ?></td>
                        <td><span class="badge <?php echo status_badge_class($p['status']); ?>"><?php echo htmlspecialchars($p['status']); ?></span></td>
                        <td><?php echo htmlspecialchars($p['updated']); ?></td>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-outline-primary me-1" title="Edit"><i class="fa-solid fa-pen"></i></a>
                            <a href="#" class="btn btn-sm btn-outline-secondary" title="View"><i class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>

