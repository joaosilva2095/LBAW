<?php 
include_once('../config/init.php');

if (isset($_SESSION['error_message'])) {
    $message = $_SESSION['error_message'];       
    echo "<script type='text/javascript'>alert('$message');</script>";
    //sleep(3);
   
   unset($_SESSION);
   session_destroy();
   session_write_close();   
    
   session_start();
}


$smarty->display('login.tpl');
?>