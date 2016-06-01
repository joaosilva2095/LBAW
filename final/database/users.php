<?php

include_once('../config/init.php');

/**
 *  Register a friend in the database

 *  @param id id of the user to be registered
 *  @param role role of the user (might be "Contabilista", "Administrador", "Amigo")
 *  @param email email of the user, it will be used to login
 *  @param password unhashed user password
 *  @param name name of the user
 *  @param gender gender of the user
 *  @param birth birth date of the user
 *  @param nif nif of the user
 *  @param cellphone cellphone of the user
 *  @param donative_type donative type of the user (might be "Referência Multibanco", "Débito Direto", "Transferência Bancária", "Numerário")Fixe
 *  @param periodicity periodicity of the donative payment
 *  @return true if successfull, false otherwise
 */
function register_friend($id, $email, $password, $name, $gender, $birth, $nif, $cellphone, $donative_type, $periodicity)
{
    // Register the user in the database
    if (!register_user($id, "Amigo", $email, $password, $name, $gender, $birth)) {
        return false;
    }

    // Register the friend
    global $conn;
    $stmt = $conn->prepare("INSERT INTO friends
                            VALUES (?, ?, ?, false, null, null, ?, ?)");
    try {
        return $stmt->execute(array($id, $nif, $cellphone, $donative_type, $periodicity));
    } catch (PDOException $e) {
        var_dump($e);
        if ($e->getCode() == 23505) {
            return false;
        } // Unique constraint violation
        else {
            return false;
        } // TODO Log to the file
    }
}

/**
 *  Register a user in the database

 *  @param id id of the user to be registered
 *  @param role role of the user (might be "Contabilista", "Administrador", "Amigo")
 *  @param email email of the user, it will be used to login
 *  @param password unhashed user password
 *  @param name name of the user
 *  @param gender gender of the user
 *  @param birth birth date of the user
 *  @return true if successfull, false otherwise
 */
function register_user($id, $role, $email, $password, $name, $gender, $birth)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    try {
        return $stmt->execute(array($id, $role, $email, $password, $name, $gender, $birth));
    } catch (PDOException $e) {
        if ($e->getCode() == 23505) {
            return false;
        } // Unique constraint violation
        else {
            return false;
        } // TODO Log to the file
    }
}

/**
 *  Remove a user from the database
 *
 *  @param id id of the user to remove
 *  @return true if successfull, false otherwise
 */
function remove_user($id)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM users
                            WHERE id = ?");
    return $stmt->execute(array($id));
}

/**
 *  Toggle pause state of user in the database
 *
 *  @param id id of the user to paused
 *  @return true if successfull, false otherwise
 */
function toggle_pause_friend($id)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE friends
                            SET frozen = NOT frozen
                            WHERE id = ?");
    return $stmt->execute(array($id));
}

/**
 *  Get all the users of the database
 *  @return all the users of the database
 */
function get_all_users()
{
    global $conn;
    $stmt = $conn->prepare("SELECT users.id, role, name, birth, frozen FROM users
                            LEFT OUTER JOIN friends
                            ON users.id = friends.id
                            ORDER BY name ASC");
    $stmt->execute();
    return $stmt->fetchAll();
}

/**
 * Search for a user in the database
 * @param user name of the user to be searched
 * @return results that match the user
 */
function get_search_user_by_name($user)
{
    global $conn;

    $user = "%".$user."%";
    $stmt = $conn->prepare("SELECT id, name, birth, role FROM users
                          WHERE LOWER(name) LIKE LOWER(?) ORDER BY name ASC");
    $stmt->execute(array($user));

    return $stmt->fetchAll();
}

/**
 * Search for a user in the database
 * @param atm_reference atm reference of the user to be searched
 * @return results that match the user's atm reference
 */
function get_search_user_by_atm_reference($atm_reference)
{
    global $conn;

    $stmt = $conn->prepare("SELECT atm_reference, users.id, name, birth, role FROM payments
                          JOIN mercha_purchases ON mercha_purchases.id = payments.id
                          JOIN donatives ON donatives.id = payments.id
                          JOIN friend_events ON friend_events.payment = payments.id
                          JOIN users ON users.id = mercha_purchases.friend
                          OR users.id = donatives.friend
                          OR users.id = friend_events.friend
                          WHERE atm_reference = ?");
    $stmt->execute(array($atm_reference));
    return $stmt->fetchAll();
}

/**
 *  Verify the user credentials by querrying the database.
 *  Uses sha256 encryptation.

 *  @param username user's name
 *  @param password user's password
 */
function is_login_correct($username, $password)
{
    global $conn;
    $stmt = $conn->prepare("SELECT *
                            FROM users
                            WHERE email = ? AND password = ?");
    $stmt->execute(array($username, hash("sha256", $password)));
    return $stmt->fetch() == true;
}

/**
 *  Get user's role.

 *  @param email user's username
 *  @returns User's role in case of success or false on failure.
 */
function get_user_role($email)
{
    global $conn;

    $stmt = $conn->prepare("SELECT ROLE
                            FROM users
                            WHERE email = ?");
    $stmt->execute(array($email));
    return $stmt->fetch();
}

/**
 *  Get user's entity by its email

 *  @param email user's username
 *  @returns User user entity or false if fail
 */
function get_user_by_email($email)
{
    global $conn;
    $stmt = $conn->prepare("SELECT *
                            FROM users
                            WHERE email = ?");
    $stmt->execute(array($email));
    return $stmt->fetch();
}

/**
 *  Get the notifications of a user

 *  @param user user to get the notifications
 *  @return all the notifications of the user
 */
function get_user_notifications($user)
{
    global $conn;
    $stmt = $conn->prepare("SELECT *
                            FROM web_notifications
                            WHERE user_id = ?");
    $stmt->execute(array($user));
    return $stmt->fetchAll();
}

/**
 *  Get friends's info (entity) from 2 querries (user + friend)

 *  @param username email user's username
 *  @returns User friend entity or false if fail
 */
function get_friend_info($username)
{
    if (($user = get_user_by_email($username)) === false) {
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
 *  Get user's history (KING OF SQL)

 *  @param id user's id
 *  @returns history user's history or false if fail
 */
function get_user_history($id)
{
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
         GROUP BY payments.id,friends.id )
UNION
    (SELECT events.id, events.event_date AS date, 'Evento' as type, events.price AS value
        FROM events, friends, friend_events
        WHERE friends.id = ?
            AND friend_events.friend = friends.id
            AND events.id = friend_events.event
        GROUP BY events.id))
ORDER BY date DESC");
    $stmt->execute(array($id,$id));

    return $stmt->fetchAll();
}

/**
 *  Get all users's history (global)

 *  @returns hystory global history
 */
function get_global_history()
{
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
