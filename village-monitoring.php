<?php
/**
 * village-monitoring.php — Village Monitoring
 */
require_once 'includes/data.php';

$page_title = 'Village Monitoring';
$breadcrumb = 'Village Monitoring';
$active     = 'villages';

include 'includes/header.php';
include 'includes/sidebar.php';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" defer></script>
<main class="ac-main-content">

    <div class="ac-breadcrumb">
        <a href="index.php" class="text-decoration-none" style="color:inherit;">Home</a> /
        <span class="current">Village Monitoring</span>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="ac-page-title">Village Monitoring</h1>
        <div class="d-flex gap-2">
            <input class="form-control form-control-sm" style="min-width:220px;" placeholder="Search villages, status or project..." aria-label="Search">
            <button class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-filter"></i> Filters</button>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <?php foreach ($overview_cards as $c): ?>
        <div class="col-6 col-md-3 col-lg-2">
            <div class="card shadow-sm h-100">
                <div class="card-body p-3 text-center">
                    <div class="mb-2 text-muted"><i class="bi <?php echo $c['icon']; ?> fa-lg"></i></div>
                    <div class="h4 mb-0"><?php echo htmlspecialchars($c['value']); ?><?php echo htmlspecialchars($c['suffix']); ?></div>
                    <small class="text-muted d-block mt-1"><?php echo htmlspecialchars($c['label']); ?></small>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Village List</strong>
            <div class="d-flex gap-2">
                <select class="form-select form-select-sm">
                    <option selected>All Statuses</option>
                    <option>On Track</option>
                    <option>Attention</option>
                    <option>Delayed</option>
                </select>
                <button class="btn btn-primary btn-sm"><i class="fa-solid fa-download"></i> Export</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Village</th>
                        <th>Population</th>
                        <th>Projects</th>
                        <th>Completed</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($villages as $v): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($v['name']); ?></td>
                        <td><?php echo number_format($v['population']); ?></td>
                        <td><?php echo htmlspecialchars($v['projects']); ?></td>
                        <td><?php echo htmlspecialchars($v['completed']); ?></td>
                        <td><span class="badge <?php echo status_badge_class($v['status']); ?>"><?php echo htmlspecialchars($v['status']); ?></span></td>
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-outline-primary me-1" title="View"><i class="fa-solid fa-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-outline-secondary" title="Details"><i class="fa-solid fa-info"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header"><strong>Project Categories</strong></div>
                <div class="card-body">
                    <?php foreach ($progress_categories as $pc): ?>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div><i class="bi <?php echo $pc['icon']; ?> me-2"></i><?php echo htmlspecialchars($pc['name']); ?></div>
                        <div><span class="text-muted me-3"><?php echo $pc['completed']; ?>/<?php echo $pc['total']; ?></span>
                            <div class="progress" style="height:8px; width:160px; display:inline-block; vertical-align:middle;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo round(($pc['completed']/$pc['total'])*100); ?>%" aria-valuenow="<?php echo round(($pc['completed']/$pc['total'])*100); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header"><strong>Recent Activity</strong></div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <?php foreach ($activities as $a): ?>
                        <li class="mb-3">
                            <div class="d-flex justify-content-between">
                                <div><i class="bi <?php echo $a['icon']; ?> me-2"></i><strong><?php echo htmlspecialchars($a['title']); ?></strong><div class="small text-muted"><?php echo htmlspecialchars($a['desc']); ?></div></div>
                                <div class="small text-muted text-end"><?php echo htmlspecialchars($a['time']); ?></div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>

