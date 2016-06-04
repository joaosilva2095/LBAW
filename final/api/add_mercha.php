<?php
/**
 * Created by IntelliJ IDEA.
 * User: diogo
 * Date: 04/06/2016
 * Time: 14:52
 */

include_once('../config/init.php');
include_once($BASE_DIR . 'database/mercha.php');

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
$params = array('id', 'category', 'description', 'price');

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
$result = addMercha(
    $params['id'],
    $params['category'],
    $params['description'],
    $params['price']);


// Return result
if ($result === false) {
    $_SESSION['error_messages'][] = 'Error while registering in the database!';
    http_response_code(404);
    return;
} else {
    $_SESSION['success_messages'][] = 'Registered successfully!';
    http_response_code(200);
    echo $result['id'];
    return;
}



?>