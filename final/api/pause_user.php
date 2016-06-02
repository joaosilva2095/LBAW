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
$result = toggle_pause_friend($params['id']);

// Return result
if ($result) {
    $_SESSION['success_messages'][] = 'Toggle paused user successfully!';
    http_response_code(200);
    return;
} else {
    $_SESSION['error_messages'][] = 'Error while toggling user pause in the database!';
    http_response_code(404);
    return;
}
