<?php
require_once __DIR__ . '/../includes/functions.php';

session_destroy();
$_SESSION = [];

$_SESSION['message'] = 'You have been logged out.';
$_SESSION['message_type'] = 'info';

header('Location: login.php');
exit();
