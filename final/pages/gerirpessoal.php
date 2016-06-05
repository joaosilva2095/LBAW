<?php
include_once('../config/init.php');
include_once($BASE_DIR . 'database/users.php');
include_once($BASE_DIR . 'database/notifications.php');

// Validate user
if (!isset($_SESSION['username'])
    || !isset($_SESSION['username'])
    || $_SESSION['role'] === 'Amigo'
) {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}

$page_title = 'Gerir Pessoal';

$role = $_SESSION['role'];

$user = get_user_by_email($_SESSION['username']);
$notifications = get_user_notifications($user['id']);
$users = get_all_users();


$viewer['name']=$user['name'];
$viewer['role']=$role;

$viewer_info = get_user_by_email($_SESSION['username']);
$viewer['role'] = $_SESSION['role'];
$viewer['name'] = $viewer_info['name'];
$viewer['id'] = $viewer_info['id'];
$viewer['email'] = $viewer_info['email'];

$smarty->assign('page_title', $page_title);
$smarty->assign('viewer', $viewer);
$smarty->assign('notifications', $notifications);
$smarty->assign('users', $users);

$smarty->display('../templates/gerirpessoal.tpl');
