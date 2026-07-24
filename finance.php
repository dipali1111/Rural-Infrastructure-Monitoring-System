<?php
/**
 * finance.php — Financial Utilization
 */
require_once 'includes/data.php';

$page_title = 'Financial Utilization';
$breadcrumb = 'Financial Utilization';
$active     = 'finance';

include 'includes/header.php';
include 'includes/sidebar.php';
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" defer></script>
<main class="ac-main-content">

    <div class="ac-breadcrumb">
        <a href="index.php" class="text-decoration-none" style="color:inherit;">Home</a> /
        <span class="current">Financial Utilization</span>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="ac-page-title">Financial Utilization</h1>
        <div>
            <button class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-file-export"></i> Export Report</button>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-3">
            <div class="card p-3 text-center">
                <div class="h5">₹<?php echo number_format(array_sum(array_column($finance,'sanctioned'))); ?> L</div>
                <small class="text-muted">Total Sanctioned (L)</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 text-center">
                <div class="h5">₹<?php echo number_format(array_sum(array_column($finance,'utilized'))); ?> L</div>
                <small class="text-muted">Total Utilized (L)</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 text-center">
                <div class="h5"><?php $san = array_sum(array_column($finance,'sanctioned')); $util=array_sum(array_column($finance,'utilized')); echo round(($util/max(1,$san))*100); ?>%</div>
                <small class="text-muted">Utilization Rate</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 text-center">
                <div class="h5"><?php echo count($finance); ?></div>
                <small class="text-muted">Heads</small>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Finance Breakdown</strong>
            <div class="d-flex gap-2">
                <input class="form-control form-control-sm" placeholder="Search head or amount">
                <button class="btn btn-sm btn-outline-secondary">Filter</button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Head</th>
                        <th>Sanctioned (L)</th>
                        <th>Utilized (L)</th>
                        <th>Balance (L)</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($finance as $f): $bal = $f['sanctioned'] - $f['utilized']; ?>
                    <tr>
                        <td><?php echo htmlspecialchars($f['head']); ?></td>
                        <td><?php echo number_format($f['sanctioned']); ?></td>
                        <td><?php echo number_format($f['utilized']); ?></td>
                        <td><?php echo number_format($bal); ?></td>
                        <td class="text-end"><a href="#" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-chart-line"></i> View</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>

