<?php
/* =====================================================
   DASHBOARD.PHP
   Main overview: KPI cards, Chart.js visualizations,
   recent activity feed, quick actions, latest projects.
   ===================================================== */
require_once 'config.php';
require_once 'includes/auth.php';
require_once 'includes/data.php';
require_login();

$pageTitle = 'Dashboard';
$metrics = get_dashboard_metrics();
$projects = get_projects();
$photos = array_slice(get_photos(), 0, 3);
$progressUpdates = array_slice(get_progress(), 0, 3);
$notifications = array_slice(get_notifications(), 0, 3);

// latest 6 projects sorted by updated date desc
usort($projects, fn($a, $b) => strcmp($b['updated'], $a['updated']));
$latestProjects = array_slice($projects, 0, 6);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, viewport-fit=cover">
<meta name="theme-color" content="#133336">
<meta name="description" content="Ahmednagar Connect - Rural Infrastructure Monitoring System">
<title><?= h($pageTitle) ?> — <?= h(APP_NAME) ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<!-- Responsive Complete Styles -->
<link rel="stylesheet" href="assets/css/responsive-complete.css">
<!-- Enhanced Responsive Utilities -->
<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
<div class="app-shell">
    <?php include 'includes/sidebar.php'; ?>

    <div class="main-content">
        <?php include 'includes/header.php'; ?>

        <main class="page-content">
            <div class="page-header">
                <div>
                    <h1>Welcome back, <?= h(explode(' ', current_officer()['name'])[0] ?? '') ?> 👋</h1>
                    <p>Here's what's happening across <?= h(current_officer()['taluka'] ?? 'your taluka') ?> today.</p>
                </div>
                <div style="display:flex; gap:10px; flex-wrap:wrap;">
                    <a href="reports.php" class="btn-outline-teal"><i class="fa-solid fa-file-export"></i> Generate Report</a>
                    <a href="projects.php?action=add" class="btn-solid-teal"><i class="fa-solid fa-plus"></i> Add New Project</a>
                </div>
            </div>

            <!-- ===================== STAT CARDS ===================== -->
            <div class="stat-grid">
                <div class="glass-card stat-card" style="animation-delay:.02s">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="fa-solid fa-city"></i></div>
                        <div class="stat-trend up"><i class="fa-solid fa-arrow-up"></i> 2 new</div>
                    </div>
                    <div class="stat-value" data-count="<?= $metrics['total_villages'] ?>">0</div>
                    <div class="stat-label">Total Villages</div>
                </div>

                <div class="glass-card stat-card" style="animation-delay:.05s">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="fa-solid fa-diagram-project"></i></div>
                        <div class="stat-trend up"><i class="fa-solid fa-arrow-up"></i> 8.3%</div>
                    </div>
                    <div class="stat-value" data-count="<?= $metrics['total_projects'] ?>">0</div>
                    <div class="stat-label">Total Projects</div>
                </div>

                <div class="glass-card stat-card" style="animation-delay:.08s">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="fa-solid fa-circle-check"></i></div>
                        <div class="stat-trend up"><i class="fa-solid fa-arrow-up"></i> On track</div>
                    </div>
                    <div class="stat-value" data-count="<?= $metrics['completed'] ?>">0</div>
                    <div class="stat-label">Completed Projects</div>
                </div>

                <div class="glass-card stat-card" style="animation-delay:.11s">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="fa-solid fa-person-digging"></i></div>
                        <div class="stat-trend flat"><i class="fa-solid fa-minus"></i> Steady</div>
                    </div>
                    <div class="stat-value" data-count="<?= $metrics['running'] ?>">0</div>
                    <div class="stat-label">Running Projects</div>
                </div>

                <div class="glass-card stat-card" style="animation-delay:.14s">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="fa-solid fa-hourglass-half"></i></div>
                        <div class="stat-trend down"><i class="fa-solid fa-arrow-down"></i> Needs action</div>
                    </div>
                    <div class="stat-value" data-count="<?= $metrics['pending'] ?>">0</div>
                    <div class="stat-label">Pending Projects</div>
                </div>

                <div class="glass-card stat-card" style="animation-delay:.17s">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                        <div class="stat-trend down"><i class="fa-solid fa-arrow-down"></i> Critical</div>
                    </div>
                    <div class="stat-value" data-count="<?= $metrics['delayed'] ?>">0</div>
                    <div class="stat-label">Delayed Projects</div>
                </div>

                <div class="glass-card stat-card" style="animation-delay:.2s">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="fa-solid fa-sack-dollar"></i></div>
                        <div class="stat-trend up"><i class="fa-solid fa-arrow-up"></i> FY 2026-27</div>
                    </div>
                    <div class="stat-value" data-count="<?= $metrics['total_budget'] ?>" data-currency="true">₹0</div>
                    <div class="stat-label">Total Budget</div>
                </div>

                <div class="glass-card stat-card" style="animation-delay:.23s">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="fa-solid fa-money-bill-trend-up"></i></div>
                        <div class="stat-trend up"><i class="fa-solid fa-arrow-up"></i> <?= round(($metrics['used_budget']/max(1,$metrics['total_budget']))*100) ?>%</div>
                    </div>
                    <div class="stat-value" data-count="<?= $metrics['used_budget'] ?>" data-currency="true">₹0</div>
                    <div class="stat-label">Fund Utilized</div>
                </div>

                <div class="glass-card stat-card" style="animation-delay:.26s">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="fa-solid fa-vault"></i></div>
                        <div class="stat-trend flat"><i class="fa-solid fa-minus"></i> Available</div>
                    </div>
                    <div class="stat-value" data-count="<?= $metrics['remaining_budget'] ?>" data-currency="true">₹0</div>
                    <div class="stat-label">Remaining Budget</div>
                </div>

                <div class="glass-card stat-card" style="animation-delay:.29s">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="fa-solid fa-helmet-safety"></i></div>
                        <div class="stat-trend flat"><i class="fa-solid fa-minus"></i> Active</div>
                    </div>
                    <div class="stat-value" data-count="<?= $metrics['total_engineers'] ?>">0</div>
                    <div class="stat-label">Total Engineers</div>
                </div>

                <div class="glass-card stat-card" style="animation-delay:.32s">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="fa-solid fa-people-roof"></i></div>
                        <div class="stat-trend flat"><i class="fa-solid fa-minus"></i> Registered</div>
                    </div>
                    <div class="stat-value" data-count="<?= $metrics['total_gps'] ?>">0</div>
                    <div class="stat-label">Total Gram Panchayats</div>
                </div>

                <div class="glass-card stat-card" style="animation-delay:.35s">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="fa-solid fa-clipboard-question"></i></div>
                        <div class="stat-trend down"><i class="fa-solid fa-arrow-down"></i> Review</div>
                    </div>
                    <div class="stat-value" data-count="<?= $metrics['pending_verifications'] ?>">0</div>
                    <div class="stat-label">Pending Verifications</div>
                </div>
            </div>

            <!-- ===================== QUICK ACTIONS ===================== -->
            <div class="quick-actions">
                <a href="projects.php?action=add" class="glass-card quick-action"><i class="fa-solid fa-plus-circle"></i><span>Add New Project</span></a>
                <a href="progress-updates.php" class="glass-card quick-action"><i class="fa-solid fa-clipboard-check"></i><span>Approve Progress</span></a>
                <a href="reports.php" class="glass-card quick-action"><i class="fa-solid fa-file-circle-plus"></i><span>Generate Report</span></a>
                <a href="village-monitoring.php" class="glass-card quick-action"><i class="fa-solid fa-map-location-dot"></i><span>View Villages</span></a>
                <a href="reports.php#pdf" class="glass-card quick-action" data-export="PDF"><i class="fa-solid fa-file-pdf"></i><span>Export PDF</span></a>
                <a href="reports.php#excel" class="glass-card quick-action" data-export="Excel"><i class="fa-solid fa-file-excel"></i><span>Export Excel</span></a>
            </div>

            <!-- ===================== CHARTS ===================== -->
            <div class="chart-grid">
                <div class="glass-card chart-card">
                    <div class="chart-head">
                        <div>
                            <h3>Project Status</h3>
                            <div class="chart-sub">Distribution across all active projects</div>
                        </div>
                    </div>
                    <div class="chart-wrap"><canvas id="chartProjectStatus"></canvas></div>
                </div>

                <div class="glass-card chart-card">
                    <div class="chart-head">
                        <div>
                            <h3>Budget Utilization</h3>
                            <div class="chart-sub">Allocated vs used vs remaining</div>
                        </div>
                    </div>
                    <div class="chart-wrap"><canvas id="chartBudget"></canvas></div>
                </div>

                <div class="glass-card chart-card">
                    <div class="chart-head">
                        <div>
                            <h3>Monthly Progress</h3>
                            <div class="chart-sub">Average completion trend (FY 2026-27)</div>
                        </div>
                    </div>
                    <div class="chart-wrap"><canvas id="chartMonthly"></canvas></div>
                </div>

                <div class="glass-card chart-card">
                    <div class="chart-head">
                        <div>
                            <h3>Work Category</h3>
                            <div class="chart-sub">Projects grouped by category</div>
                        </div>
                    </div>
                    <div class="chart-wrap"><canvas id="chartCategory"></canvas></div>
                </div>
            </div>

            <!-- ===================== RECENT ACTIVITY ===================== -->
            <div class="chart-grid" style="grid-template-columns: repeat(auto-fit, minmax(280px,1fr));">
                <div class="glass-card activity-card">
                    <h3><i class="fa-solid fa-clock-rotate-left"></i> Latest Project Updates</h3>
                    <?php foreach ($progressUpdates as $u): $p = get_project_by_id($u['project_id']); ?>
                    <div class="activity-item">
                        <div class="activity-icon"><i class="fa-solid fa-chart-line"></i></div>
                        <div>
                            <div class="activity-title"><?= h($p['name'] ?? $u['project_id']) ?></div>
                            <div class="activity-sub"><?= h($u['note']) ?> &middot; <?= h($u['date']) ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="glass-card activity-card">
                    <h3><i class="fa-regular fa-images"></i> Recent Photo Uploads</h3>
                    <?php foreach ($photos as $ph): ?>
                    <div class="activity-item">
                        <div class="activity-icon"><i class="fa-regular fa-image"></i></div>
                        <div>
                            <div class="activity-title"><?= h($ph['caption']) ?></div>
                            <div class="activity-sub"><?= h($ph['project_id']) ?> &middot; <?= h($ph['date']) ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="glass-card activity-card">
                    <h3><i class="fa-solid fa-bell"></i> Alerts</h3>
                    <?php foreach ($notifications as $n): ?>
                    <div class="activity-item">
                        <div class="activity-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                        <div>
                            <div class="activity-title"><?= h($n['type']) ?></div>
                            <div class="activity-sub"><?= h($n['message']) ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- ===================== LATEST PROJECTS TABLE ===================== -->
            <div class="glass-card table-card">
                <div class="table-toolbar">
                    <h3 style="margin:0; font-size:14.5px;">Latest Projects</h3>
                    <a href="projects.php" class="btn-outline-teal"><i class="fa-solid fa-list"></i> View All Projects</a>
                </div>
                <div class="table-responsive-wrap">
                    <table class="gov-table">
                        <thead>
                            <tr>
                                <th>Project ID</th>
                                <th>Village</th>
                                <th>Category</th>
                                <th>Budget</th>
                                <th>Progress</th>
                                <th>Status</th>
                                <th>Engineer</th>
                                <th>Last Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($latestProjects as $p): ?>
                            <tr>
                                <td><?= h($p['id']) ?></td>
                                <td><?= h($p['village']) ?></td>
                                <td><?= h($p['category']) ?></td>
                                <td><?= format_inr($p['budget']) ?></td>
                                <td>
                                    <div class="progress-mini"><span style="width:<?= (int)$p['progress'] ?>%"></span></div>
                                </td>
                                <td><span class="badge-status badge-<?= strtolower($p['status']) ?>"><?= h($p['status']) ?></span></td>
                                <td><?= h(engineer_name($p['engineer_id'])) ?></td>
                                <td><?= h($p['updated']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <?php include 'includes/footer.php'; ?>
    </div>
</div>

<script>
const statusData = <?= json_encode($metrics['status_counts']) ?>;
const categoryData = <?= json_encode($metrics['category_counts']) ?>;
const budgetTotal = <?= (int)$metrics['total_budget'] ?>;
const budgetUsed = <?= (int)$metrics['used_budget'] ?>;
const budgetRemaining = <?= (int)$metrics['remaining_budget'] ?>;

Chart.defaults.color = 'rgba(255,255,255,0.65)';
Chart.defaults.font.family = 'Poppins, sans-serif';

// 1. Project Status
new Chart(document.getElementById('chartProjectStatus'), {
    type: 'doughnut',
    data: {
        labels: Object.keys(statusData),
        datasets: [{
            data: Object.values(statusData),
            backgroundColor: ['#367D8A', '#285F6B', '#79C1CC', '#8a4a44'],
            borderColor: '#133336',
            borderWidth: 3,
            hoverOffset: 8
        }]
    },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, padding: 14 } } } }
});

// 2. Budget Utilization
new Chart(document.getElementById('chartBudget'), {
    type: 'bar',
    data: {
        labels: ['Allocated', 'Used', 'Remaining'],
        datasets: [{
            data: [budgetTotal, budgetUsed, budgetRemaining],
            backgroundColor: ['#285F6B', '#367D8A', '#79C1CC'],
            borderRadius: 10,
            maxBarThickness: 60
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false } },
            y: { grid: { color: 'rgba(255,255,255,0.06)' }, ticks: { callback: v => '₹' + (v/100000) + 'L' } }
        }
    }
});

// 3. Monthly Progress (line)
new Chart(document.getElementById('chartMonthly'), {
    type: 'line',
    data: {
        labels: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        datasets: [{
            label: 'Avg. Completion %',
            data: [18, 27, 38, 49, 58, 62],
            borderColor: '#79C1CC',
            backgroundColor: 'rgba(54,125,138,0.25)',
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#285F6B',
            pointRadius: 4
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false } },
            y: { grid: { color: 'rgba(255,255,255,0.06)' }, ticks: { callback: v => v + '%' } }
        }
    }
});

// 4. Work Category
new Chart(document.getElementById('chartCategory'), {
    type: 'polarArea',
    data: {
        labels: Object.keys(categoryData),
        datasets: [{
            data: Object.values(categoryData),
            backgroundColor: ['rgba(40,95,107,0.75)', 'rgba(54,125,138,0.75)', 'rgba(121,193,204,0.75)', 'rgba(19,51,54,0.9)', 'rgba(90,150,150,0.6)']
        }]
    },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, padding: 12 } } }, scales: { r: { grid: { color: 'rgba(255,255,255,0.08)' }, ticks: { display: false } } } }
});
</script>
</body>
</html>
