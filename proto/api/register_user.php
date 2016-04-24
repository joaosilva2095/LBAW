<?php 
include_once('../../config/init.php');
include_once($BASE_DIR.'database/users.php');

// Check if the user is logged in


// Role
if (!isset($_POST['role'])) {
    $_SESSION['error_messages'][] = 'Parameters are missing!';
    header('', true, 404);
    return;
}
$role = $_POST['role'];

// Check if all parameters exist
$params = array('id', 'email', 'password', 'name', 'gender', 'birth');
if ($role === 'Amigo') array_push($params, 'nif', 'cellphone', 'donative_type', 'periodicity', 'donative_amount');

foreach($params as $param) {
    if (!isset($_POST[$param])) {
        $_SESSION['error_messages'][] = 'Parameters are missing!';
        header('', true, 404);
        return;
    } else {
        $params[$param] = $_POST[$param];
    }
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

// Return result
if ($result) {
    $_SESSION['success_messages'][] = 'Registered successfully!';
    header('', true, 200);
    return;
} else {
    $_SESSION['error_messages'][] = 'Error while registering in the database!';
    header('', true, 404);
    return;
}

?>