<?php
include_once('../config/init.php');
include_once($BASE_DIR . 'database/users.php');
include_once($BASE_DIR . 'database/events.php');
include_once($BASE_DIR . 'database/notifications.php');

// Validate user
if (!isset($_SESSION['username'])
    || !isset($_SESSION['username'])
    || ($_SESSION['role'] === 'Amigo')
) {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}

// Verify parameters
if (isset($_GET['search'])) {
    $search = $_GET['search'];
} else {
    $search = "";
}

// ATM reference
if (is_numeric($search)) {
    $atm_users = get_search_user_by_atm_reference($search);
    $smarty->assign('atm_users', $atm_users);
} // Friend name or event description
else {
    $name_users = get_search_user_by_name($search);
    if(count($name_users) > 0)
        $smarty->assign('name_users', $name_users);

    $events = get_search_event_by_description($search);
    if(count($events) > 0)
        $smarty->assign('events', $events);
}

$page_title = 'Pesquisa por ' . $search;

$role = $_SESSION['role'];
$user = get_user_by_email($_SESSION['username']);
$notifications = get_user_notifications($user['id']);


$viewer_info = get_user_by_email($_SESSION['username']);
$viewer['role'] = $_SESSION['role'];
$viewer['name'] = $viewer_info['name'];
$viewer['id'] = $viewer_info['id'];
$viewer['email'] = $viewer_info['email'];

$smarty->assign('page_title', $page_title);
$smarty->assign('viewer', $viewer);
$smarty->assign('notifications', $notifications);

$smarty->display('../templates/pesquisa.tpl');
