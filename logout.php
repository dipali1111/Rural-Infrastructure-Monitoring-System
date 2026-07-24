<?php
// logout.php — simple session destroy and redirect
session_start();
session_unset();
session_destroy();
header('Location: index.php');
exit;
