<?php
include_once('../config/init.php');
include_once($BASE_DIR . 'database/notifications.php');

// Validate user
if (!isset($_SESSION['username'])
    || !isset($_SESSION['role'])
    || $_SESSION['role'] === 'Amigo') {
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

// Add notification
$result = mark_as_seen($params['id']);

// Return result
if ($result) {
    $_SESSION['success_messages'][] = 'Marked notification as seen successfully!';
    http_response_code(200);
    return;
} else {
    $_SESSION['error_messages'][] = 'Error while marking notification as seen in the database!';
    http_response_code(404);
    return;
}
