<?php
/**
 * progress-updates.php — Progress Updates
 */
require_once 'includes/data.php';

$page_title = 'Progress Updates';
$breadcrumb = 'Progress Updates';
$active     = 'progress';

include 'includes/header.php';
include 'includes/sidebar.php';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" defer></script>
<main class="ac-main-content">

    <div class="ac-breadcrumb">
        <a href="index.php" class="text-decoration-none" style="color:inherit;">Home</a> /
        <span class="current">Progress Updates</span>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="ac-page-title">Progress Updates</h1>
        <div>
            <button class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-plus"></i> Add Update</button>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <div class="card p-3">
                <h6 class="mb-2">Recent Updates</h6>
                <ul class="list-unstyled mb-0">
                    <?php foreach ($activities as $a): ?>
                    <li class="mb-3">
                        <div class="d-flex">
                            <div class="me-3"><i class="bi <?php echo $a['icon']; ?> fa-lg"></i></div>
                            <div>
                                <strong><?php echo htmlspecialchars($a['title']); ?></strong>
                                <div class="small text-muted"><?php echo htmlspecialchars($a['desc']); ?></div>
                                <div class="small text-muted"><?php echo htmlspecialchars($a['time']); ?></div>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Progress Feed</strong>
                    <div class="d-flex gap-2">
                        <input class="form-control form-control-sm" placeholder="Filter by project id or village">
                        <select class="form-select form-select-sm">
                            <option selected>All Categories</option>
                            <?php foreach ($progress_categories as $pc): ?>
                            <option><?php echo htmlspecialchars($pc['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Time</th>
                                <th>Activity</th>
                                <th>Project</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($activities as $a): ?>
                            <tr>
                                <td class="small text-muted"><?php echo htmlspecialchars($a['time']); ?></td>
                                <td><?php echo htmlspecialchars($a['title']); ?><div class="small text-muted"><?php echo htmlspecialchars($a['desc']); ?></div></td>
                                <td>—</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-eye"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>

