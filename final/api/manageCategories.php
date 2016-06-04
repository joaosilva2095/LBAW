<?php
/**
 * Created by IntelliJ IDEA.
 * User: diogo
 * Date: 04/06/2016
 * Time: 17:50
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
$result = false;

if (!isset($_POST['type']) && !isset($_POST['category'])) {
    $_SESSION['error_messages'][] = 'Parameters are missing!';
    http_response_code(404);
    return;
} else {
    $type = $_POST['type'];
    $category = $_POST['category'];
}

if ($type === 'CREATE') {
    $result = newCategory($category);
} else if ($type === 'DELETE') {
    $result = delCategory($category);
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
