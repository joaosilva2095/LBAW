<?php
include_once('../config/init.php');
include_once($BASE_DIR . 'database/notifications.php');

// Validate user
if (!isset($_SESSION['username'])
    || !isset($_SESSION['username'])
    || $_SESSION['role'] === 'Amigo'
) {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}

// Check if all parameters exist
$params = array('id', 'message', 'type');

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
$result = add_notification($params['id'], $params['message'], $params['type']);

// Return result
if ($result) {
    $_SESSION['success_messages'][] = 'Added notification to the user successfully!';
    http_response_code(200);
    return;
} else {
    $_SESSION['error_messages'][] = 'Error while adding notification to the user in the database!';
    http_response_code(404);
    return;
}
