<?php
/**
 * config/db.php
 * Rural Infrastructure Monitoring System - Ahmednagar
 *
 * Central MySQLi connection file. Every backend page/controller should
 * require_once this file rather than opening its own connection, so the
 * whole team shares one configuration and one place to change it.
 */

// ---------------------------------------------------------------------
// Local XAMPP defaults. Do NOT commit real production credentials here -
// for anything beyond local development, move these into environment
// variables and keep this file free of secrets.
// ---------------------------------------------------------------------
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'rural_infra_monitoring');
define('DB_PORT', 3306);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    // Never leak connection details to the browser in a government system.
    error_log('DB connection failed: ' . $e->getMessage());
    http_response_code(500);
    die('A system error occurred. Please contact the administrator.');
}

/**
 * Always use prepared statements with this connection, e.g.:
 *
 *   $stmt = $conn->prepare("SELECT * FROM projects WHERE gp_id = ?");
 *   $stmt->bind_param('i', $gpId);
 *   $stmt->execute();
 *   $result = $stmt->get_result();
 *
 * Never concatenate user input directly into SQL strings.
 */
