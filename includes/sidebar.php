<?php
/**
 * sidebar.php
 * Left navigation sidebar. Expects $active to be set by the including
 * page (e.g. $active = 'dashboard';) to highlight the current menu item.
 */
if (!isset($active)) { $active = 'dashboard'; }

// Compute base path so links work when app is served from a subdirectory
$__ac_base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
if ($__ac_base === '/' || $__ac_base === '.') { $__ac_base = ''; }

$menu = [
    ['key' => 'dashboard',      'label' => t('menu_dashboard'),      'icon' => 'bi-speedometer2',      'href' => 'index.php'],
    ['key' => 'villages',       'label' => t('menu_villages'),       'icon' => 'bi-signpost-2',        'href' => 'village-monitoring.php'],
    ['key' => 'projects',       'label' => t('menu_projects'),       'icon' => 'bi-kanban',            'href' => 'projects.php'],
    ['key' => 'progress',       'label' => t('menu_progress'),       'icon' => 'bi-graph-up-arrow',    'href' => 'progress-updates.php'],
    ['key' => 'gallery',        'label' => t('menu_gallery'),        'icon' => 'bi-images',            'href' => 'gallery.php'],
    ['key' => 'finance',        'label' => t('menu_finance'),        'icon' => 'bi-cash-stack',        'href' => 'finance.php'],
    ['key' => 'verifications',  'label' => t('menu_verifications'),  'icon' => 'bi-patch-check',       'href' => 'verifications.php'],
    ['key' => 'alerts',         'label' => t('menu_alerts'),         'icon' => 'bi-bell',              'href' => 'alerts.php'],
    ['key' => 'reports',        'label' => t('menu_reports'),        'icon' => 'bi-bar-chart-line',    'href' => 'reports.php'],
];

$menu_bottom = [
    ['key' => 'profile',  'label' => t('menu_profile'),  'icon' => 'bi-person-circle', 'href' => 'profile.php'],
    ['key' => 'settings', 'label' => t('menu_settings'), 'icon' => 'bi-gear',          'href' => 'settings.php'],
];
?>
<aside class="ac-sidebar" id="acSidebar">
    <nav class="ac-sidebar-nav">
        <ul>
            <?php foreach ($menu as $item): ?>
            <li>
                <a href="<?php echo $__ac_base . '/' . ltrim($item['href'], '/'); ?>" class="ac-sidebar-link <?php echo $active === $item['key'] ? 'active' : ''; ?>">
                    <i class="bi <?php echo $item['icon']; ?>"></i>
                    <span><?php echo $item['label']; ?></span>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>

        <hr class="ac-sidebar-divider">

        <ul>
            <?php foreach ($menu_bottom as $item): ?>
            <li>
                <a href="<?php echo $__ac_base . '/' . ltrim($item['href'], '/'); ?>" class="ac-sidebar-link <?php echo $active === $item['key'] ? 'active' : ''; ?>">
                    <i class="bi <?php echo $item['icon']; ?>"></i>
                    <span><?php echo $item['label']; ?></span>
                </a>
            </li>
            <?php endforeach; ?>
            <li>
                <a href="<?php echo $__ac_base . '/logout.php'; ?>" class="ac-sidebar-link ac-logout-link">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
