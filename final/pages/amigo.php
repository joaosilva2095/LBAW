<?php
include_once('../config/init.php');
include_once($BASE_DIR . 'database/users.php');

$role = $_SESSION['role'];

if (strcmp($role, "Amigo") != 0) {
    header('Location: '.$_SERVER['HTTP_REFERER']); //redirects to previous page
    exit;
}

//TODO VERIFICAR SE DÁ FALSE
$friend = get_friend_info($_SESSION['username']);

//TODO VERIFICAR SE DÁ FALSE
$history = get_user_history($friend['id']);

$smarty->assign('user', $friend);
$smarty->assign('history', $history);


$smarty->display('../templates/amigo.tpl');

?>