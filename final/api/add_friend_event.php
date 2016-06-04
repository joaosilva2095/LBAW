<?php
include_once('../config/init.php');
include_once($BASE_DIR . 'database/events.php');

// Validate user
if (!isset($_SESSION['username'])
    || !isset($_SESSION['role'])
    || $_SESSION['role'] !== 'Contabilista') {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}

// Check if all parameters exist
$params = array('eventId', 'userId', 'paymentId');

foreach ($params as $param) {
    if (!isset($_POST[$param])) {
        $_SESSION['error_messages'][] = 'Parameters are missing!';
        http_response_code(404);
        return;
    } else {
        $params[$param] = $_POST[$param];
    }
}

// Add friend event
$result = add_friend_event($params['eventId'], $params['userId'], $params['paymentId']);

// Return result
if ($result) {
    $_SESSION['success_messages'][] = 'Added user to the event successfully!';
    http_response_code(200);
    return;
} else {
    $_SESSION['error_messages'][] = 'Error while adding the user to the event in the database!';
    http_response_code(404);
    return;
}
