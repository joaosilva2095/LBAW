<?php
include_once('../config/init.php');
include_once($BASE_DIR . 'database/users.php');

// Validate user
if (!isset($_SESSION['username'])
    || !isset($_SESSION['role'])
    || $_SESSION['role'] !== 'Contabilista') {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}

// Check if all parameters exist
$params = array('userId', 'date', 'atmReference', 'donativeType', 'value');

foreach ($params as $param) {
    if (!isset($_POST[$param])) {
        $_SESSION['error_messages'][] = 'Parameters are missing!';
        http_response_code(404);
        return;
    } else {
        $params[$param] = $_POST[$param];
    }
}

// Check for the receipt
if (!isset($_FILES["file"])) {
    $_SESSION['error_messages'][] = 'Parameters are missing!';
    http_response_code(404);
    return;
}

$file=$_FILES["file"];
if ($file["type"]=="application/pdf" && $file["size"]<1000000 && $file["error"]==0) {
    $hashfile=hash("sha256", $file["name"].$file["size"].date('d')).".pdf";
    move_uploaded_file($file["tmp_name"], "../receipts/".$hashfile);

    $result = add_donative(
        $params['userId'],
        $params['date'],
        $params['atmReference'],
        $params['donativeType'],
        $params['value'],
        $hashfile
    );
} else {
    $_SESSION['error_messages'][] = 'Invalid receipt file!';
    http_response_code(404);
    return;
}

// Return result
if ($result) {
    $_SESSION['success_messages'][] = 'Added user donative successfully!';
    http_response_code(200);
    return;
} else {
    $_SESSION['error_messages'][] = 'Error while adding the user donative in the database!';
    http_response_code(404);
    return;
}
