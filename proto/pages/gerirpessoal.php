<?php 
include_once('../config/init.php');
include_once($BASE_DIR.'database/users.php');

// TODO check permissions

// TODO remove this variables
$users = get_all_users();
$user=array('name' => 'João Silva', 'role' => 'Admin');
$notifications=array();

$smarty->assign('notifications', $notifications);
$smarty->assign('user', $user);
$smarty->assign('users', $users);

$smarty->display('gerirpessoal.tpl');
?>