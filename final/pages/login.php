<?php
include_once('../config/init.php');

// Check if he is logged in already
if (isset($_SESSION['username'])) {
    switch ($_SESSION['role']) {
        case "Administrador":
            header('Location: ../pages/admin.php');
            break;
        case "Contabilista":
            header('Location: ../pages/contabilista.php');
            break;
        case "Amigo":
            header('Location: ../pages/amigo.php');
            break;
        default:
            $_SESSION['error_messages'] = "Invalid Privileges";
            header('Location: ../actions/logout.php');
            exit;
    }
}

$smarty->display('login.tpl');
?>