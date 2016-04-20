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
    @param nif nif of the user´
    @param cellphone cellphone of the user
    @param donative_type donative type of the user "Referência Multibanco", "Débito Direto", "Transferência Bancária", "Numerário"
    @param periodicity periodicity of the donative payment
 */
function register_friend($id, $role, $email, $password, $name, $gender, $birth, $nif, $cellphone, $donative_type, $periodicity) {
    // Register the user in the database
    register_user($id, $role, $email, $password, $name, $gender, $birth);

    // Register the friend
    global $conn;
    $stmt = $conn->prepare("INSERT INTO friends 
                            VALUES (?, ?, ?, false, null, null, ?, ?)");
    $stmt->execute($id, $nif, $cellphone, $donative_type, $periodicity);
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
    $stmt->execute($id, $role, $email, $password, $name, $gender, $birth);
}
?>