<?php
include_once('../config/init.php');
include_once($BASE_DIR . 'database/events.php');

// Validate user
if (!isset($_SESSION['username'])
    || !isset($_SESSION['role'])
    || $_SESSION['role'] !== 'Contabilista') {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}

// Check if all parameters exist
$params = array('eventId', 'userId', 'paymentDate', 'paymentATMReference', 'paymentValue');

foreach ($params as $param) {
    if (!isset($_POST[$param])) {
        $_SESSION['error_messages'][] = 'Parameters are missing!';
        http_response_code(404);
        return;
    } else {
        $params[$param] = $_POST[$param];
    }
}

// Check for the price
if ($params['paymentValue'] === 0) { // Free event
    $result = add_friend_free_event(
        $params['eventId'],
        $params['userId']
    );
} else { // Paid event
    if (!isset($_FILES["file"])) {
        $_SESSION['error_messages'][] = 'Parameters are missing!';
        http_response_code(404);
        return;
    }

    $file=$_FILES["file"];
    if ($file["type"]=="application/pdf" && $file["size"]<1000000 && $file["error"]==0) {
        $hashfile=hash("sha256", $file["name"].$file["size"].date('d')).".pdf";
        move_uploaded_file($file["tmp_name"], "../receipts/".$hashfile);

        $result = add_friend_event(
            $params['eventId'],
            $params['userId'],
            $params['paymentDate'],
            $params['paymentATMReference'],
            $params['paymentValue'],
            $hashfile
        );
    } else {
        $_SESSION['error_messages'][] = 'Invalid receipt file!';
        http_response_code(404);
        return;
    }
}

// Return result
if ($result) {
    $_SESSION['success_messages'][] = 'Added user to the event successfully!';
    http_response_code(200);
    return;
} else {
    $_SESSION['error_messages'][] = 'Error while adding the user to the event in the database!';
    http_response_code(404);
    return;
}
