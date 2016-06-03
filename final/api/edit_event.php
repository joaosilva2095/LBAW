<?php
include_once('../config/init.php');
include_once($BASE_DIR . 'database/events.php');

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
$params = array('id', 'name', 'description', 'date', 'duration', 'place', 'price');


foreach ($params as $param) {
    if (!isset($_POST[$param])) {
        $_SESSION['error_messages'][] = 'Parameters are missing!';
        http_response_code(404);
        return;
    } else {
        $params[$param] = $_POST[$param];
    }
}

// Insert in the database
$result = edit_event(
    $params['id'],
    $params['name'],
    $params['description'],
    $params['date'],
    $params['duration'],
    $params['place'],
    $params['price']);


// Return result
if ($result) {
    $_SESSION['success_messages'][] = 'Edited successfully!';
    http_response_code(200);
    return;
} else {
    $_SESSION['error_messages'][] = 'Error while editing in the database!';
    http_response_code(404);
    return;
}
