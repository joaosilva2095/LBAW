<?php 

//==============================//
function destroy_session() {
    unset($_SESSION);
    session_destroy();
    session_write_close();
}
//==============================//

/*action page*/
include_once("../database/users.php");

//Input	control
if (!$_POST['username'] || !$_POST['password']) {
    $_SESSION['error_messages'] = "Invalid Login";
    $_SESSION['form_values'] = $_POST;
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];

//Data	operations
if (is_login_correct($username, $password)) {
    $_SESSION['username'] = $username;
    $_SESSION['success_messages'] = 'Login successful';

    /*Get user's role*/
    //echo "<script type='text/javascript'>alert('$username');</script>";
    //sleep(3);    

    $role = get_user_role($username);

    if ($role === false || count($role) == 0) { //Error
        $_SESSION['error_messages'] = 'Role not found';
        //destroy_session();
        header('Location:'.$_SERVER['HTTP_REFERER']);
        exit;
    }

    /* Redirects to user's home page according to user's role */
       
    switch ($role['role']) {
        case "Administrador":
            $_SESSION['role'] = $role['role'];
            header('Location: ../pages/admin.php');
            break;
        case "Contabilista":
            $_SESSION['role'] = $role['role'];
            header('Location: ../pages/contabilista.php');
            break;
        case "Amigo":
            $_SESSION['role'] = $role['role'];
            header('Location: ../pages/amigo.php');
            break;
        default:
            //Error
            $_SESSION['error_messages'] = "Invalid Privileges";
           // destroy_session();
            header('Location:'.$_SERVER['HTTP_REFERER']);
            exit;
    }
} else {
    $_SESSION['error_messages'] = 'Login failed';
    // destroy_session();
    //Redirect to login
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit;
}

?>