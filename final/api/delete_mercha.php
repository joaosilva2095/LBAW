<?php
include_once('../config/init.php');
include_once($BASE_DIR . 'database/mercha.php');

// Validate user
if (!isset($_SESSION['username'])
    || !isset($_SESSION['role'])
    || $_SESSION['role'] !== 'Administrador'
) {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}

// Check if all parameters exist
$params = array('id');

foreach ($params as $param) {
    if (!isset($_POST[$param])) {
        $_SESSION['error_messages'][] = 'Parameters are missing!';
        http_response_code(404);
        return;
    } else {
        $params[$param] = $_POST[$param];
    }
}

// Remove from the database
$result = remove_mercha($params['id']);

// Return result
if ($result) {
    $_SESSION['success_messages'][] = 'Removed merchadising product successfully!';
    http_response_code(200);
    return;
} else {
    $_SESSION['error_messages'][] = 'Error while removing merchadising product in the database!';
    http_response_code(404);
    return;
}
