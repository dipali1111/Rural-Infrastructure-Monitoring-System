<?php
session_start();

// Set default language to English if not set
if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'en';
}

// Get language from URL parameter if provided
if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'mr'])) {
    $_SESSION['language'] = $_GET['lang'];
}

// Load language file
$current_lang = $_SESSION['language'];
$lang_file = __DIR__ . '/languages/' . $current_lang . '.php';

if (file_exists($lang_file)) {
    $lang = require($lang_file);
} else {
    // Fallback to English
    $lang = require(__DIR__ . '/languages/en.php');
}

// Function to get translation
function __($key) {
    global $lang;
    return isset($lang[$key]) ? $lang[$key] : $key;
}

// Function to get current language
function get_current_lang() {
    return $_SESSION['language'] ?? 'en';
}
?>
