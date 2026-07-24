<?php
/**
 * index.php — Main Dashboard
 * Frontend-only demo. No database, no authentication, no backend logic.
 * All data below comes from includes/data.php as static dummy values.
 */
require_once 'includes/data.php';

$page_title  = 'Dashboard';
$breadcrumb  = 'Dashboard';
$active      = 'dashboard';

include 'includes/header.php';
include 'includes/sidebar.php';
?>
<main class="ac-main-content">

    <div class="ac-breadcrumb">
        <a href="index.php" class="text-decoration-none" style="color:inherit;"><?php echo htmlspecialchars(t('home')); ?></a> /
        <span class="current"><?php echo htmlspecialchars(t('dashboard')); ?></span>
    </div>

    <!-- ============ WELCOME BANNER ============ -->
    <div class="ac-welcome">
        <div>
            <h2><?php echo htmlspecialchars(t('welcome')); ?> <?php echo htmlspecialchars($officer['name']); ?></h2>
            <p><?php echo htmlspecialchars($officer['role']); ?> &middot; <?php echo htmlspecialchars($officer['taluka']); ?></p>
        </div>
        <div class="ac-welcome-meta">
            <div class="ac-welcome-chip"><i class="bi bi-calendar3"></i> <?php echo date('d M Y'); ?></div>
            <div class="ac-welcome-chip"><i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($officer['taluka']); ?></div>
            <div class="ac-welcome-chip"><i class="bi bi-signpost-2"></i> <?php echo htmlspecialchars(t('district')); ?></div>
        </div>
    </div>

    <!-- ============ QUICK OVERVIEW CARDS ============ -->
    <div class="row g-3">
        <?php foreach ($overview_cards as $card): ?>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="ac-glass-card">
                <div class="ac-kpi-icon"><i class="bi <?php echo $card['icon']; ?>"></i></div>
                <div class="ac-kpi-value" data-counter="<?php echo (int)$card['value']; ?>" data-suffix="<?php echo $card['suffix']; ?>">0<?php echo $card['suffix']; ?></div>
                <div class="ac-kpi-label"><?php echo $card['label']; ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-8">

            <!-- ============ PROGRESS OVERVIEW ============ -->
            <div class="ac-section-title">
                <h4><?php echo htmlspecialchars(t('progress_overview')); ?></h4>
                <a href="progress-updates.php"><?php echo htmlspecialchars(t('view_all')); ?> <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="row g-3">
                <?php foreach ($progress_categories as $cat):
                    $remaining = $cat['total'] - $cat['completed'];
                    $percent = $cat['total'] > 0 ? round(($cat['completed'] / $cat['total']) * 100) : 0;
                ?>
                <div class="col-12 col-md-6">
                    <div class="ac-progress-card">
                        <div class="ac-progress-card-head">
                            <div class="ac-progress-card-icon"><i class="bi <?php echo $cat['icon']; ?>"></i></div>
                            <p class="ac-progress-card-title"><?php echo $cat['name']; ?></p>
                        </div>
                        <div class="ac-progress-stats">
                            <span><?php echo htmlspecialchars(t('total')); ?>: <strong><?php echo $cat['total']; ?></strong></span>
                            <span><?php echo htmlspecialchars(t('done')); ?>: <strong><?php echo $cat['completed']; ?></strong></span>
                            <span><?php echo htmlspecialchars(t('left')); ?>: <strong><?php echo $remaining; ?></strong></span>
                        </div>
                        <div class="ac-progress-track">
                            <div class="ac-progress-fill" data-progress="<?php echo $percent; ?>"></div>
                        </div>
                        <div class="text-end mt-1" style="font-size:0.72rem;color:var(--ac-secondary);"><?php echo $percent; ?><?php echo htmlspecialchars(t('complete')); ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- ============ RECENT PROJECT TABLE ============ -->
            <div class="ac-section-title">
                <h4><?php echo htmlspecialchars(t('recent_projects')); ?></h4>
                <a href="projects.php"><?php echo htmlspecialchars(t('view_all')); ?> <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="ac-table-card">
                <div class="table-responsive">
                    <table class="table ac-table">
                        <thead>
                            <tr>
                                <th><?php echo htmlspecialchars(t('project_id')); ?></th>
                                <th><?php echo htmlspecialchars(t('village')); ?></th>
                                <th><?php echo htmlspecialchars(t('category')); ?></th>
                                <th><?php echo htmlspecialchars(t('budget')); ?></th>
                                <th><?php echo htmlspecialchars(t('status')); ?></th>
                                <th><?php echo htmlspecialchars(t('last_updated')); ?></th>
                                <th class="text-center"><?php echo htmlspecialchars(t('action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($projects as $p): ?>
                            <tr>
                                <td class="fw-semibold" style="color:var(--ac-primary);"><?php echo $p['id']; ?></td>
                                <td><?php echo $p['village']; ?></td>
                                <td><?php echo $p['category']; ?></td>
                                <td><?php echo $p['budget']; ?></td>
                                <td><span class="ac-badge <?php echo status_badge_class($p['status']); ?>"><?php echo $p['status']; ?></span></td>
                                <td><?php echo $p['updated']; ?></td>
                                <td class="text-center">
                                    <a href="projects.php" class="ac-action-btn" title="View details"><i class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ============ RECENT ALERTS ============ -->
            <div class="ac-section-title">
                <h4><?php echo htmlspecialchars(t('recent_alerts')); ?></h4>
                <a href="alerts.php"><?php echo htmlspecialchars(t('view_all')); ?> <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="ac-card">
                <div class="ac-timeline">
                    <?php foreach ($alerts as $a): ?>
                    <div class="ac-timeline-item">
                        <div class="ac-timeline-icon text-<?php echo $a['color']; ?>"><i class="bi <?php echo $a['icon']; ?> text-<?php echo $a['color']; ?>"></i></div>
                        <div class="ac-timeline-body">
                            <div class="ac-timeline-title"><?php echo $a['type']; ?></div>
                            <div class="ac-timeline-desc"><?php echo $a['desc']; ?></div>
                            <div class="ac-timeline-time"><?php echo $a['time']; ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>

        <div class="col-12 col-lg-4">

            <!-- ============ QUICK ACTIONS ============ -->
            <div class="ac-section-title" style="margin-top:0;">
                <h4><?php echo htmlspecialchars(t('quick_actions')); ?></h4>
            </div>
            <div class="ac-card mb-4">
                <a href="progress-updates.php" class="ac-quick-action"><i class="bi bi-clipboard-plus"></i> <?php echo htmlspecialchars(t('add_inspection')); ?></a>
                <a href="verifications.php" class="ac-quick-action"><i class="bi bi-cloud-upload"></i> <?php echo htmlspecialchars(t('upload_verification')); ?></a>
                <a href="reports.php" class="ac-quick-action"><i class="bi bi-file-earmark-bar-graph"></i> <?php echo htmlspecialchars(t('generate_report')); ?></a>
                <a href="village-monitoring.php" class="ac-quick-action"><i class="bi bi-signpost-2"></i> <?php echo htmlspecialchars(t('view_village')); ?></a>
                <a href="reports.php" class="ac-quick-action"><i class="bi bi-file-earmark-pdf"></i> <?php echo htmlspecialchars(t('download_pdf')); ?></a>
            </div>

            <!-- ============ RECENT ACTIVITY ============ -->
            <div class="ac-section-title" style="margin-top:0;">
                <h4><?php echo htmlspecialchars(t('recent_activity')); ?></h4>
            </div>
            <div class="ac-card">
                <div class="ac-timeline">
                    <?php foreach ($activities as $act): ?>
                    <div class="ac-timeline-item">
                        <div class="ac-timeline-icon text-primary"><i class="bi <?php echo $act['icon']; ?>"></i></div>
                        <div class="ac-timeline-body">
                            <div class="ac-timeline-title"><?php echo $act['title']; ?></div>
                            <div class="ac-timeline-desc"><?php echo $act['desc']; ?></div>
                            <div class="ac-timeline-time"><?php echo $act['time']; ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>

<?php include 'includes/footer.php'; ?>
