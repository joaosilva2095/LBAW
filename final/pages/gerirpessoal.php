<?php
include_once('../config/init.php');
include_once($BASE_DIR . 'database/users.php');

// Validate user
if (!isset($_SESSION['username'])
    || !isset($_SESSION['username'])
    || $_SESSION['role'] === 'Amigo'
) {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}
$role = $_SESSION['role'];

$user = get_user_by_email($_SESSION['username']);
$notifications = get_user_notifications($user['id']);
$users = get_all_users();

$smarty->assign('role', $role);
$smarty->assign('user', $user);
$smarty->assign('notifications', $notifications);
$smarty->assign('users', $users);

$smarty->display('../templates/gerirpessoal.tpl');
