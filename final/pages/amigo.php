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

$friend = get_friend_info($_SESSION['username']);

$user_id = $friend['id'];

$event_history = get_user_event_history($user_id);
$event_payment_history = get_user_event_payments($user_id);
$donatives = get_user_donative_history($user_id);
$mercha_payments = get_user_merchandise_history($user_id);


$smarty->assign('user', $friend);

$smarty->assign('event_history', $event_history);
$smarty->assign('event_payment_history', $event_payment_history);
$smarty->assign('donatives', $donatives);
$smarty->assign('mercha_payments', $mercha_payments);


$smarty->display('../templates/amigo.tpl');

?>
