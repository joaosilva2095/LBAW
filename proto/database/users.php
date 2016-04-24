<?php 

include_once("../config/init.php");

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
    @param donative_amount donative amount of the user
    @return true if successfull, false otherwise
 */
function register_friend($id, $email, $password, $name, $gender, $birth, $nif, $cellphone, $donative_type, $periodicity, $donative_amount) {
    // Register the user in the database
    if (!register_user($id, "Amigo", $email, $password, $name, $gender, $birth)) return false;

    // Register the friend
    global $conn;
    $stmt = $conn->prepare("INSERT INTO friends 
                            VALUES (?, ?, ?, false, null, null, ?, ?, ?)");
    return $stmt->execute($id, $nif, $cellphone, $donative_type, $periodicity, $donative_amount);
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
    @return true if successfull, false otherwise
 */
function register_user($id, $role, $email, $password, $name, $gender, $birth) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    return $stmt->execute($id, $role, $email, $password, $name, $gender, $birth);
}

/**
    Get all the users of the database
    @return all the users of the database
 */
function get_all_users() {
    global $conn;
    $stmt = $conn->prepare("SELECT id, role, name, birth FROM users");
    $stmt->execute();
    return $stmt->fetchAll();
}

/**
    Verify the user credentials by querrying the database.
    Uses sha256 encryptation.
   
    @param username user's name
    @param password user's password   
**/

function is_login_correct($username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * 
                            FROM users 
                            WHERE email = ? AND password = ?");
    $stmt->execute(array($username, hash("sha256", $password)));
    return $stmt->fetch() == true;
}

/**
    Get user's role.
   
    @param email user's username
    @returns User's role in case of success or false on failure.    
**/
function get_user_role($email) {
    global $conn;
    $stmt = $conn->prepare("SELECT ROLE 
                            FROM users 
                            WHERE email = ?");
    $stmt->execute(array($email));
    return $stmt->fetch();
}

/**
    Get user's entity
   
    @param email user's username
    @returns User user entity or false if fail   
**/
function get_user_by_name($email) {
    global $conn;
    $stmt = $conn->prepare("SELECT * 
                            FROM users 
                            WHERE email = ?");
    $stmt->execute(array($email));
    return $stmt->fetch();
}


/**
    Get friends's info (entity) from 2 querries (user + friend)
   
    @param email user's username
    @returns User friend entity or false if fail   
**/
function get_friend_info($username) {
    if (($user = get_user_by_name($username)) === false) {
        return false;
    }

    global $conn;
    $stmt = $conn->prepare("SELECT * 
                            FROM friends 
                            WHERE id = ?");

    $stmt->execute(array($user['id']));
    
    $friend = $stmt->fetchAll();

    if ($friend === false) {
        return false;
    }

    return array_merge($user, $friend);
}

/**
    Get user's history (KING OF SQL)
   
    @param id user's id
    @returns history user's history or false if fail   
**/
function get_user_history($id) {
    global $conn;

    //get payments history
    $stmt = $conn->prepare("
    ((SELECT payments.id AS id, payments.payment_date AS date,payments.payment_type AS type, payments.value AS value 
         FROM users,friends, payments, donatives, mercha_purchases
         WHERE friends.id = ?
         AND ( 
              (donatives.friend = friends.id
               AND payments.id = donatives.id) 
              OR
              (payments.id = mercha_purchases.id AND
               mercha_purchases.friend = friends.id)
         )
         GROUP BY payments.id,friends.id)
    UNION
    (SELECT events.id, events.event_date AS date, 'Evento' as type, events.price AS value
        FROM events, payments, friends, friend_events,users
        WHERE users.id = ?
        AND events.id = friend_events.event
        AND friend_events.friend = users.id        
        GROUP BY events.id)) 
        ORDER BY date DESC");
        
    $stmt->execute(array($id,$id));
    return $stmt->fetchAll();
}

/**
    Get all users's history (global)
   
    @returns hystory global history  
**/
function get_global_history() {
    global $conn;

    //get payments history
    $stmt = $conn->prepare("((SELECT friends.id, payments.id, payments.payment_date AS date,payments.payment_type AS type, payments.value AS value 
         FROM users,friends, payments, donatives, mercha_purchases
         WHERE friends.id = users.id
         AND ( 
              (payments.id = donatives.id
               AND donatives.friend = friends.id) 
              OR
              (payments.id = mercha_purchases.id AND
               mercha_purchases.id = payments.id)
         )
         GROUP BY payments.id,friends.id)
    UNION
        (SELECT friends.id, events.id, events.event_date AS date, 'Evento' as type, events.price AS value
        FROM events, payments, friends, friend_events,users
        WHERE events.id = friend_events.event
        AND friend_events.friend = friends.id
        AND users.id = friends.id
        GROUP BY events.id,friends.id)) 
        ORDER BY date"
        );

    $stmt->execute();
    return $stmt->fetchAll();
}


?>