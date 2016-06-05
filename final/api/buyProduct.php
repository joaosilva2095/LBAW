<?php
/**
 * Created by IntelliJ IDEA.
 * User: diogo
 * Date: 04/06/2016
 * Time: 22:51
 */
include_once('../config/init.php');
include_once($BASE_DIR . 'database/mercha.php');
// Validate user
if (!isset($_SESSION['username'])
    || !isset($_SESSION['role'])
    || $_SESSION['role'] !== 'Contabilista'
) {
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    http_response_code(404);
    return;
}

var_dump($_FILES);
var_dump($_POST);

// Check if all parameters exist
$params = array('idUser', 'datePayment', 'productId','quantity');

foreach ($params as $param) {
    if (!isset($_POST[$param])) {
        $_SESSION['error_messages'][] = 'Parameters are missing!';
        http_response_code(404);
        return;
    } else {
        $params[$param] = $_POST[$param];
    }
}
if(isset($_FILES["file"])){
    $file=$_FILES["file"];
    if($file["type"]=="application/pdf" && $file["size"]<1000000 && $file["error"]==0){
        $hashfile=hash("sha256", $file["name"].$file["size"].date('d')).".pdf";
        move_uploaded_file($file["tmp_name"], "../receipts/".$hashfile);
        $result = addMerchaPurchaseFile(
            $params['idUser'],
            $params['datePayment'],
            $params['productId'],
            $params['quantity'],
            $hashfile);
    }
}else {
// Insert in the database
    $result = addMerchaPurchase(
        $params['idUser'],
        $params['datePayment'],
        $params['productId'],
        $params['quantity']);
}

// Return result
if ($result === false) {
    $_SESSION['error_messages'][] = 'Error while registering in the database!';
    http_response_code(404);
    return;
} else {
    $_SESSION['success_messages'][] = 'Registered successfully!';
    http_response_code(200);
    echo "success";
    return;
}



?>
