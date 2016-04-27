<?php
include_once('../config/init.php');

unset($_SESSION);
session_destroy();
session_write_close();

session_start();

header('Location: ' . $BASE_URL . 'pages/login.php');
?>