<?php
include_once('../config/init.php');
include_once($BASE_DIR.'database/users.php');

// Validate user

if (!isset($_SESSION['username'])
    || !isset($_SESSION['role'])
    || $_SESSION['role'] === 'Amigo') {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}


$params = array('id', 'type');

foreach($params as $param) {
    if (!isset($_POST[$param])) {
        $_SESSION['error_messages'][] = 'Parameters are missing!';
        http_response_code(404);
        return;
    } else {
        $params[$param] = $_POST[$param];
    }
}

$result = remove_history_entry(
                        $params['id'],
                        $params['type']);

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