<?php 
include_once('../config/init.php');
include_once($BASE_DIR.'database/users.php');

echo $_SESSION['role'];
// Validate user
if (!isset($_SESSION['username'])
|| !isset($_SESSION['username'])
|| $_SESSION['role'] !== 'Administrador') {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}

echo '1';
// Role
if (!isset($_POST['role'])) {
    $_SESSION['error_messages'][] = 'Parameters are missing!';
    http_response_code(404);
    return;
}

// Check if all parameters exist
$params = array('id', 'role', 'email', 'password', 'name', 'gender', 'birth');
if ($_POST['role'] === 'Amigo') array_push($params, 'nif', 'cellphone', 'donative_type', 'periodicity');

echo '2';
foreach($params as $param) {
    if (!isset($_POST[$param])) {
        $_SESSION['error_messages'][] = 'Parameters are missing!';
        http_response_code(404);
        return;
    } else {
        $params[$param] = $_POST[$param];
    }
}

echo '3';
// Validate input parameters
if (!filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error_messages'][] = 'Invalid input emails!';
    http_response_code(404);
    return;
}

// Insert in the database
if ($role === 'Amigo') {
    $result = register_friend(
    $params['id'],
    $params['email'],
    sha1($params['password']),
    $params['name'],
    $params['gender'],
    $params['birth'],
    $params['nif'],
    $params['cellphone'],
    $params['donative_type'],
    $params['periodicity'],
    $params['donative_amount']);
} else {
    $result = register_user(
    $params['id'],
    $params['role'],
    $params['email'],
    sha1($params['password']),
    $params['name'],
    $params['gender'],
    $params['birth']);
}

echo '4';
// Return result
if ($result) {
    $_SESSION['success_messages'][] = 'Registered successfully!';
    http_response_code(200);
    return;
} else {
    $_SESSION['error_messages'][] = 'Error while registering in the database!';
    http_response_code(404);
    return;
}

?>