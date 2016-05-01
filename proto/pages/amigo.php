<?php 
include_once('../config/init.php');
include_once($BASE_DIR.'database/users.php');

$role = $_SESSION['role'];

if ($role != "Amigo") {
    header('Location: '.$_SERVER['HTTP_REFERER']); //redirects to previous page
    exit;
}


$friend = get_friend_info($_SESSION['username']);

if ($friend === false) {
    unset($_SESSION);
    session_destroy();
    session_write_close();

    $smarty->display('../templates/login.tpl');
}


$history = get_user_history($friend['id']);

$smarty->assign('user', $friend);
$smarty->assign('history', $history);
$smarty->display('../templates/amigo.tpl');

?>