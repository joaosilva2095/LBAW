<?php 
include_once('../config/init.php');
include_once($BASE_DIR.'database/users.php');

// Validate user
if (!isset($_SESSION['username']) || !isset($_SESSION['username'])) {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}

$params = array('id', 'email', 'name', 'cellphone', 'birth');

foreach($params as $param) {
    if (!isset($_POST[$param])) {
        $_SESSION['error_messages'][] = 'Parameters are missing!';
        http_response_code(404);
        return;
    } else {
        $params[$param] = $_POST[$param];
    }
}

// Validate input parameters
if (!filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error_messages'][] = 'Invalid input emails!';
    http_response_code(404);
    return;
}

var_dump($params);

$result = edit_friend_short(
$params['id'],
$params['email'],
$params['name'],
$params['birth'],
$params['cellphone']
);

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

?>