<?php

/**
    Register a friend in the database
    
    @param id id of the user to be registered
    @param role role of the user (might be "Contabilista", "Administrador", "Amigo")
    @param email email of the user, it will be used to login
    @param password unhashed user password
    @param name name of the user
    @param gender gender of the user
    @param birth birth date of the user
    @param nif nif of the user
    @param cellphone cellphone of the user
    @param donative_type donative type of the user (might be "Referência Multibanco", "Débito Direto", "Transferência Bancária", "Numerário")Fixe
    @param periodicity periodicity of the donative payment
 */
function register_friend($id, $email, $password, $name, $gender, $birth, $nif, $cellphone, $donative_type, $periodicity) {
    // Register the user in the database
    register_user($id, "Amigo", $email, $password, $name, $gender, $birth);

    // Register the friend
    global $conn;
    $stmt = $conn->prepare("INSERT INTO friends 
                            VALUES (?, ?, ?, false, null, null, ?, ?)");
    return $stmt->execute($id, $nif, $cellphone, $donative_type, $periodicity);
}

/**
    Register a user in the database

    @param id id of the user to be registered
    @param role role of the user (might be "Contabilista", "Administrador", "Amigo")
    @param email email of the user, it will be used to login
    @param password unhashed user password
    @param name name of the user
    @param gender gender of the user
    @param birth birth date of the user
 */
function register_user($id, $role, $email, $password, $name, $gender, $birth) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    return $stmt->execute($id, $role, $email, $password, $name, $gender, $birth);
}

/**
    Verify the user credentials by querrying the database.
    Uses sha256 encryptation.
   
    @param username user's name
    @param password user's password   
**/

function isLoginCorrect($username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * 
                            FROM users 
                            WHERE email = ? AND password = ?");
    $stmt->execute(array($username, sha1($password)));
    return $stmt->fetch() == true;
  }

?>