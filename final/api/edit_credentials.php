<?php 
include_once('../config/init.php');
include_once($BASE_DIR.'database/users.php');

// Validate user
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}

$params = array('id', 'old_name', 'new_name', 'old_pw', 'new_pw', 'confirm_pw');

foreach($params as $param) {
    if (!isset($_POST[$param])) {
        $_SESSION['error_messages'][] = 'Parameters are missing!';
        http_response_code(404);
        return;
    } else {
        $params[$param] = $_POST[$param];
    }
}

$result = edit_credentials(
$params['id'],
$params['old_name'],
$params['new_name'],
$params['old_pw'],
$params['new_pw'],
$params['confirm_pw']);

// Return result
if ($result) {
    $_SESSION['success_messages'][] = 'Edited successfully!';
    http_response_code(200);
    return $result;
} else {
    $_SESSION['error_messages'][] = 'Error while editing in the database!';
    http_response_code(404);
    return $result;
}

?>