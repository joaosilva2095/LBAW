<?php
include_once('../config/init.php');
include_once($BASE_DIR . 'database/users.php');
include_once($BASE_DIR . 'database/mercha.php');
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
$role = $_SESSION['role'];

$user = get_user_by_email($_SESSION['username']);
$notifications = get_user_notifications($user['id']);
$merchas = get_all_mercha();
$categories = getAllCategories();

$viewer['name']=$user['name'];
$viewer['role']=$role;

$smarty->assign('viewer', $viewer);
$smarty->assign('notifications', $notifications);
$smarty->assign('merchas', $merchas);
$smarty->assign('categories', $categories);

$smarty->display('../templates/gerirmercha.tpl');
