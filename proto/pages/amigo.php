<?php 
include_once('../config/init.php');
include_once($BASE_DIR.'database/users.php');

$role = $_SESSION['role'];

if ($role != "Amigo") {
    header('Location: '.$_SERVER['HTTP_REFERER']); //redirects to previous page
    exit;
}

//TODO VERIFICAR SE DÁ FALSE
$friend = get_friend_info($_SESSION['username']);

//TODO VERIFICAR SE DÁ FALSE
$history = get_user_history($user.id);

$smarty->assign('user', $friend);
$smarty->assign('hystory', $hystory);
$smarty->display('../templates/amigo.tpl');

?>