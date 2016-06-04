<?php
include_once('../config/init.php');
include_once($BASE_DIR . 'database/users.php');
include_once($BASE_DIR . 'database/notifications.php');

// Validate user
if (!isset($_SESSION['username'])
    || !isset($_SESSION['username'])
    || $_SESSION['role'] !== 'Amigo'
) {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}
$role = $_SESSION['role'];

$user = get_user_by_email($_SESSION['username']);
$notifications = get_user_notifications($user['id']);
$users = get_all_users();

$viewer['name']=$user['name'];
$viewer['role']=$role;

$smarty->assign('viewer', $viewer);
$smarty->assign('notifications', $notifications);
$smarty->assign('users', $users);

$smarty->display('../templates/homepage.tpl');
