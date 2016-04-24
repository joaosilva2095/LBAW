<?php 
include_once('../config/init.php');
include_once($BASE_DIR.'database/users.php');

// Check if the user is logged in
if(!isset($_SESSION['username'])) {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}

$users = get_all_users();

// TODO Check permissions
$user=array('name' => 'João Silva', 'role' => 'Admin');
$notifications=array();

$smarty->assign('notifications', $notifications);
$smarty->assign('user', $user);
$smarty->assign('users', $users);

$smarty->display('gerirpessoal.tpl');
?>