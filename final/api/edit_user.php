<?php
include_once('../config/init.php');
include_once($BASE_DIR . 'database/users.php');

// Validate user
if (!isset($_SESSION['username'])
    || !isset($_SESSION['role'])
    || $_SESSION['role'] !== 'Administrador'
) {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}

// Role
if (!isset($_POST['role'])) {
    $_SESSION['error_messages'][] = 'Parameters are missing!';
    http_response_code(404);
    return;
}

// Check if all parameters exist
$params = array('id', 'role', 'email', 'name', 'gender', 'birth');
if ($_POST['role'] === 'Amigo') {
    array_push($params, 'nif', 'cellphone', 'donative_type', 'periodicity');
}

foreach ($params as $param) {
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

// Insert in the database
if ($params['role'] === 'Amigo') {
    $result = edit_friend(
        $params['id'],
        $params['email'],
        $params['name'],
        $params['gender'],
        $params['birth'],
        $params['nif'],
        $params['cellphone'],
        $params['donative_type'],
        $params['periodicity']);
} else {
    $result = edit_user(
        $params['id'],
        $params['role'],
        $params['email'],
        $params['name'],
        $params['gender'],
        $params['birth']);
}


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
