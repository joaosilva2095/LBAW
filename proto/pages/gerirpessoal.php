<?php 
include_once('../config/init.php');
include_once($BASE_DIR.'database/users.php');

// TODO remove this variables
$users = array();
$user=array('name' => 'João Silva', 'role' => 'Admins');
$notifications=array();

$smarty->assign('notifications', $notifications);
$smarty->assign('user', $user);
$smarty->assign('users', $users);

$smarty->display('gerirpessoal.tpl');
?>