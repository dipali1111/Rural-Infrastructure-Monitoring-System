<?php
/**
 * data.php
 * ------------------------------------------------------------------
 * Central dummy-data file for Ahmednagar Connect.
 * No database is used anywhere in this project — every value below
 * is static sample data for frontend demonstration purposes only.
 * ------------------------------------------------------------------
 */

$officer = [
    'name'   => 'Rajesh Deshmukh',
    'role'   => 'Taluka Officer',
    'taluka' => 'Rahata Taluka',
    'photo'  => 'assets/images/logo.png'
];

$overview_cards = [
    ['label' => 'Total Villages',        'value' => 82,  'icon' => 'bi-signpost-2',      'suffix' => ''],
    ['label' => 'Total Projects',        'value' => 214, 'icon' => 'bi-kanban',          'suffix' => ''],
    ['label' => 'Projects In Progress',  'value' => 96,  'icon' => 'bi-cone-striped',     'suffix' => ''],
    ['label' => 'Completed Projects',    'value' => 88,  'icon' => 'bi-check2-circle',    'suffix' => ''],
    ['label' => 'Delayed Projects',      'value' => 18,  'icon' => 'bi-exclamation-triangle', 'suffix' => ''],
    ['label' => 'Pending Approvals',     'value' => 12,  'icon' => 'bi-hourglass-split',  'suffix' => ''],
    ['label' => 'Total Budget (Cr)',     'value' => 45,  'icon' => 'bi-cash-stack',       'suffix' => ''],
    ['label' => 'Budget Utilized',       'value' => 67,  'icon' => 'bi-pie-chart',        'suffix' => '%'],
];

$progress_categories = [
    ['name' => 'Road Projects',    'icon' => 'bi-signpost-split', 'total' => 48, 'completed' => 30],
    ['name' => 'School Buildings', 'icon' => 'bi-building',        'total' => 26, 'completed' => 20],
    ['name' => 'Water Supply',     'icon' => 'bi-droplet',         'total' => 34, 'completed' => 19],
    ['name' => 'Drainage',         'icon' => 'bi-water',           'total' => 22, 'completed' => 12],
    ['name' => 'Health Centers',   'icon' => 'bi-hospital',        'total' => 14, 'completed' => 9],
    ['name' => 'Electricity',      'icon' => 'bi-lightning-charge','total' => 30, 'completed' => 22],
];

$projects = [
    ['id' => 'PRJ-1042', 'village' => 'Loni Kh.',    'category' => 'Road',        'budget' => '₹28.5 L', 'status' => 'Completed',   'updated' => '18 Jul 2026'],
    ['id' => 'PRJ-1043', 'village' => 'Rahata',      'category' => 'Water Supply','budget' => '₹42.0 L', 'status' => 'In Progress', 'updated' => '19 Jul 2026'],
    ['id' => 'PRJ-1044', 'village' => 'Shirdi',      'category' => 'School',      'budget' => '₹65.2 L', 'status' => 'Pending',     'updated' => '15 Jul 2026'],
    ['id' => 'PRJ-1045', 'village' => 'Kopargaon',   'category' => 'Drainage',    'budget' => '₹19.8 L', 'status' => 'Delayed',     'updated' => '10 Jul 2026'],
    ['id' => 'PRJ-1046', 'village' => 'Sangamner',   'category' => 'Electricity', 'budget' => '₹31.4 L', 'status' => 'In Progress', 'updated' => '19 Jul 2026'],
    ['id' => 'PRJ-1047', 'village' => 'Rahuri',      'category' => 'Health Center','budget'=> '₹52.0 L', 'status' => 'Completed',   'updated' => '12 Jul 2026'],
    ['id' => 'PRJ-1048', 'village' => 'Nevasa',      'category' => 'Road',        'budget' => '₹24.6 L', 'status' => 'Pending',     'updated' => '08 Jul 2026'],
];

$alerts = [
    ['type' => 'Late Progress',         'desc' => 'Road widening work at Nevasa has not been updated in 15 days.', 'time' => '2 hours ago',  'icon' => 'bi-clock-history', 'color' => 'danger'],
    ['type' => 'Missing Documents',     'desc' => 'Completion certificate pending for PRJ-1046, Sangamner.',       'time' => '5 hours ago',  'icon' => 'bi-file-earmark-excel', 'color' => 'warning'],
    ['type' => 'Budget Exceeded',       'desc' => 'Drainage project at Kopargaon has exceeded sanctioned budget by 8%.', 'time' => '1 day ago', 'icon' => 'bi-cash-coin', 'color' => 'danger'],
    ['type' => 'Verification Pending',  'desc' => 'Site verification pending for water supply scheme, Rahata.',    'time' => '2 days ago',  'icon' => 'bi-patch-question', 'color' => 'info'],
];

$activities = [
    ['title' => 'Photo Upload',           'desc' => 'Site photos uploaded for PRJ-1043, Rahata.',        'time' => 'Today, 10:24 AM', 'icon' => 'bi-camera'],
    ['title' => 'Project Approved',       'desc' => 'PRJ-1041 school building, Shirdi — approved.',      'time' => 'Today, 09:10 AM', 'icon' => 'bi-check-circle'],
    ['title' => 'Budget Updated',         'desc' => 'Revised budget entered for PRJ-1045, Kopargaon.',    'time' => 'Yesterday, 4:45 PM', 'icon' => 'bi-cash-stack'],
    ['title' => 'Inspection Completed',   'desc' => 'Field inspection completed at Rahuri health center.', 'time' => 'Yesterday, 2:15 PM', 'icon' => 'bi-clipboard-check'],
];

$villages = [
    ['name' => 'Rahata',     'population' => 24500, 'projects' => 18, 'completed' => 11, 'status' => 'On Track'],
    ['name' => 'Shirdi',     'population' => 38200, 'projects' => 22, 'completed' => 14, 'status' => 'On Track'],
    ['name' => 'Loni Kh.',   'population' => 19800, 'projects' => 14, 'completed' => 12, 'status' => 'On Track'],
    ['name' => 'Kopargaon',  'population' => 45300, 'projects' => 27, 'completed' => 13, 'status' => 'Attention'],
    ['name' => 'Sangamner',  'population' => 52100, 'projects' => 31, 'completed' => 20, 'status' => 'On Track'],
    ['name' => 'Rahuri',     'population' => 33700, 'projects' => 19, 'completed' => 9,  'status' => 'Attention'],
    ['name' => 'Nevasa',     'population' => 21400, 'projects' => 12, 'completed' => 4,  'status' => 'Delayed'],
];

$finance = [
    ['head' => 'Road Development',   'sanctioned' => 1200, 'utilized' => 860],
    ['head' => 'Water Supply',       'sanctioned' => 950,  'utilized' => 640],
    ['head' => 'School Buildings',   'sanctioned' => 780,  'utilized' => 590],
    ['head' => 'Health Centers',     'sanctioned' => 610,  'utilized' => 410],
    ['head' => 'Drainage',           'sanctioned' => 430,  'utilized' => 210],
    ['head' => 'Electricity',        'sanctioned' => 530,  'utilized' => 380],
];

$verifications = [
    ['id' => 'VER-301', 'project' => 'PRJ-1043 Water Supply, Rahata',   'submitted' => '17 Jul 2026', 'status' => 'Pending'],
    ['id' => 'VER-302', 'project' => 'PRJ-1046 Electricity, Sangamner', 'submitted' => '16 Jul 2026', 'status' => 'Pending'],
    ['id' => 'VER-303', 'project' => 'PRJ-1048 Road, Nevasa',          'submitted' => '14 Jul 2026', 'status' => 'Pending'],
    ['id' => 'VER-304', 'project' => 'PRJ-1044 School, Shirdi',        'submitted' => '11 Jul 2026', 'status' => 'Under Review'],
];

$gallery = [
    ['title' => 'Road Widening – Nevasa',        'category' => 'Road',        'date' => '19 Jul 2026'],
    ['title' => 'Overhead Tank – Rahata',         'category' => 'Water Supply','date' => '18 Jul 2026'],
    ['title' => 'Classroom Block – Shirdi',       'category' => 'School',      'date' => '16 Jul 2026'],
    ['title' => 'Drainage Line – Kopargaon',      'category' => 'Drainage',    'date' => '15 Jul 2026'],
    ['title' => 'PHC Renovation – Rahuri',        'category' => 'Health',      'date' => '12 Jul 2026'],
    ['title' => 'Transformer Install – Sangamner','category' => 'Electricity', 'date' => '10 Jul 2026'],
];

$reports = [
    ['name' => 'Monthly Progress Report – June 2026',  'type' => 'PDF', 'size' => '1.2 MB', 'date' => '01 Jul 2026'],
    ['name' => 'Budget Utilization Summary – Q1 FY26', 'type' => 'PDF', 'size' => '860 KB', 'date' => '05 Jul 2026'],
    ['name' => 'Village-wise Project Status',           'type' => 'XLS', 'size' => '540 KB', 'date' => '12 Jul 2026'],
    ['name' => 'Delayed Projects Analysis',             'type' => 'PDF', 'size' => '710 KB', 'date' => '17 Jul 2026'],
];

/** Helper: map status text to a badge color class used throughout the UI */
function status_badge_class(string $status): string {
    switch (strtolower($status)) {
        case 'completed':      return 'badge-completed';
        case 'in progress':    return 'badge-progress';
        case 'pending':        return 'badge-pending';
        case 'delayed':        return 'badge-delayed';
        case 'under review':   return 'badge-progress';
        case 'on track':       return 'badge-completed';
        case 'attention':      return 'badge-pending';
        default:                return 'badge-pending';
    }
}
