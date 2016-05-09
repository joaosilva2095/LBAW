<?php 
include_once('../config/init.php');
include_once($BASE_DIR.'database/users.php');

$role = $_SESSION['role'];

if (strcmp($role, "Administrador") != 0) {    
    header('Location: '.$_SERVER['HTTP_REFERER']); //redirects to previous page
    $_SESSION['error_messages'][] = 'No permission to access this page!';
    exit;
} else {
    //TODO smarty->display("../templates/visaogeral.tpl");
    header('Location: gerirpessoal.php');
}