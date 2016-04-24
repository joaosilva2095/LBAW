<?php 
include_once('../config/init.php');
include_once($BASE_DIR.'database/users.php');

$user = get_user_by_name($_SESSION['username']);
$users = get_all_users();
$notifications = array();

$smarty->assign('notifications', $notifications);
$smarty->assign('user', $user);
$smarty->assign('users', $users);

$smarty->display('../templates/gerirpessoal.tpl');
?>