<?php 
include_once('../config/init.php');
include_once($BASE_DIR.'database/users.php');
include_once($BASE_DIR.'database/notifications.php');


// Validate user
if (!isset($_SESSION['username']) || !isset($_SESSION['username'])) {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}
$user_id = $_GET['user'];
$roleUserPage=get_user_by_id($user_id)['role'];

if($roleUserPage!=='Amigo'){
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}

if ($_SESSION['role'] != 'Amigo') {
    $friend = get_friend_info_by_id($user_id);
} else {
    $friend = get_friend_info($_SESSION['username']);
    $user_id = $friend['id'];
}

$page_title = 'Página Amigo';

$viewer_info = get_user_by_email($_SESSION['username']);
$viewer['role'] = $_SESSION['role'];
$viewer['name'] = $viewer_info['name'];
$viewer['id'] = $viewer_info['id'];
$viewer['email'] = $viewer_info['email'];

$event_history = get_user_event_history($user_id);
$event_payment_history = get_user_event_payments($user_id);
$donatives = get_user_donative_history($user_id);
$mercha_payments = get_user_merchandise_history($user_id);

$smarty->assign('page_title', $page_title);
$smarty->assign('viewer', $viewer);
$smarty->assign('user', $friend);
$smarty->assign('event_history', $event_history);
$smarty->assign('event_payment_history', $event_payment_history);
$smarty->assign('donatives', $donatives);
$smarty->assign('mercha_payments', $mercha_payments);


$smarty->display('../templates/amigo.tpl');

?>
