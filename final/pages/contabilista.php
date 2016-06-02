<?php
include_once('../config/init.php');
include_once($BASE_DIR . 'database/users.php');

// Validate user
if (!isset($_SESSION['username'])
    || !isset($_SESSION['username'])
    || $_SESSION['role'] !== 'Contabilista'
) {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}

$role = $_SESSION['role'];

if (strcmp($role, "Contabilista") != 0) {
    header('Location: ' . $_SERVER['HTTP_REFERER']); //redirects to previous page
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    exit;
} else {
    header('Location: gerirpessoal.php');
}
