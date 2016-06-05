<?php
include_once('../config/init.php');
include_once($BASE_DIR . 'database/users.php');
include_once($BASE_DIR . 'database/notifications.php');

// Validate user
if (!isset($_SESSION['username'])
    || !isset($_SESSION['username'])
    || ($_SESSION['role'] === 'Amigo')
) {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}

// Verify parameters
if (isset($_GET['user'])) {
    $user = $_GET['user'];
} else {
    $user = "";
}

// ATM reference
if (is_numeric($user)) {
    $atm_users = get_search_user_by_atm_reference($user);
    $smarty->assign('atm_users', $atm_users);
} // Friend name
else {
    $name_users = get_search_user_by_name($user);
    $smarty->assign('name_users', $name_users);
}

$role = $_SESSION['role'];
$user = get_user_by_email($_SESSION['username']);
$notifications = get_user_notifications($user['id']);


$viewer_info = get_user_by_email($_SESSION['username']);
$viewer['role'] = $_SESSION['role'];
$viewer['name'] = $viewer_info['name'];
$viewer['id'] = $viewer_info['id'];
$viewer['email'] = $viewer_info['email'];

$smarty->assign('viewer', $viewer);
$smarty->assign('notifications', $notifications);

$smarty->display('../templates/pesquisa.tpl');
