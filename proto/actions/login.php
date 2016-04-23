<?php 

/*action page*/

//Input	control
if (!$_GET['username'] || !$_GET['password']) {
    $_SESSION['error_messages'][] = 'Invalid login';
    $_SESSION['form_values'] = $_GET;
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit;
}

$username = $_GET['username'];
$password = $_GET['password'];

//Data	operations
if (is_login_correct($username, $password)) {
    $_SESSION['username'] = $username;
    $_SESSION['success_messages'][] = 'Login successful';  
  } else {
    $_SESSION['error_messages'][] = 'Login failed';  
  }
  
  //Redirect
  header('Location: ' . $_SERVER['HTTP_REFERER']);

?>