<?php

include_once('../config/init.php');
include_once($BASE_DIR . 'database/charts.php');

// Validate user
if (!isset($_SESSION['username'])
    || !isset($_SESSION['role'])
    || $_SESSION['role'] !== 'Administrador') {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}

$arr = getNumUsers();
$arr1 = getProfit();

$data = array();
$data['users'] = $arr;
$data['profit'] = $arr1;

echo json_encode($data);


