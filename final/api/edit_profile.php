<?php 
include_once('../config/init.php');
include_once($BASE_DIR.'database/users.php');

$params = array('id', 'name', 'birth', 'cellphone');


foreach($params as $param) {
    if (!isset($_POST[$param])) {
        $_SESSION['error_messages'][] = 'Parameters are missing!';
        http_response_code(404);
        return;
    } else {
        $params[$param] = $_POST[$param];
    }
}


$result = edit_friend_short(
            $params['id'],
            $params['name'],
            $params['birth'],
            $params['cellphone']);


// Return result
if ($result) {
    $_SESSION['success_messages'][] = 'Edited successfully!';
    http_response_code(200);
    return $result;
} else {
    $_SESSION['error_messages'][] = 'Error while editing in the database!';
    http_response_code(404);
    return $result;
}

?>