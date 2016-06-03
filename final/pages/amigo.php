<?php
include_once('../config/init.php');
include_once($BASE_DIR . 'database/users.php');
include_once($BASE_DIR . 'database/notifications.php');


// Validate user
if (!isset($_SESSION['username'])
    || !isset($_SESSION['username'])
) {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}

//TODO VERIFICAR SE DÁ FALSE
$friend = get_friend_info($_SESSION['username']);

//TODO VERIFICAR SE DÁ FALSE
$history = get_user_history($friend['id']);

$smarty->assign('user', $friend);
$smarty->assign('history', $history);


$smarty->display('../templates/amigo.tpl');

?>
