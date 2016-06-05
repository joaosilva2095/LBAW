<?php

/**
 *  Register a friend in the database
 * @param id id of the user to be registered
 * @param role role of the user (might be "Contabilista", "Administrador", "Amigo")
 * @param email email of the user, it will be used to login
 * @param password unhashed user password
 * @param name name of the user
 * @param gender gender of the user
 * @param birth birth date of the user
 * @param nif nif of the user
 * @param cellphone cellphone of the user
 * @param donative_type donative type of the user
 * (might be "Referência Multibanco", "Débito Direto", "Transferência Bancária", "Numerário")
 * @param periodicity periodicity of the donative payment
 * @return true if successfull, false otherwise
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
                            VALUES (?, ?, ?, FALSE, current_date, NULL, ?, ?)");
    try {
        return $stmt->execute(array($id, $nif, $cellphone, $donative_type, $periodicity));
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
 *  Register a user in the database
 * @param id id of the user to be registered
 * @param role role of the user (might be "Contabilista", "Administrador", "Amigo")
 * @param email email of the user, it will be used to login
 * @param password unhashed user password
 * @param name name of the user
 * @param gender gender of the user
 * @param birth birth date of the user
 * @return true if successfull, false otherwise
 */
function register_user($id, $role, $email, $password, $name, $gender, $birth)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users
                            VALUES (?, ?, ?, ?, ?, ?, ?)");

    return $stmt->execute(array($id, $role, $email, $password, $name, $gender, $birth));
}

/**
 *  Remove a user from the database
 *
 * @param id id of the user to remove
 * @return true if successfull, false otherwise
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
 * @param id id of the user to paused
 * @return true if successfull, false otherwise
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
 *  Edit a friend in the database
 * @param id id of the user to be edited
 * @param role role of the user (might be "Contabilista", "Administrador", "Amigo")
 * @param email email of the user, it will be used to login
 * @param name name of the user
 * @param gender gender of the user
 * @param birth birth date of the user
 * @param nif nif of the user
 * @param cellphone cellphone of the user
 * @param donative_type donative type of the user
 * (might be "Referência Multibanco", "Débito Direto", "Transferência Bancária", "Numerário")
 * @param periodicity periodicity of the donative payment
 * @return true if successfull, false otherwise
 */
function edit_friend($id, $email, $name, $gender, $birth, $nif, $cellphone, $donative_type, $periodicity)
{
    global $conn;

    // Check if is a new friend
    $stmt = $conn->prepare("SELECT id FROM friends WHERE id = ?");
    if (!$stmt->execute(array($id))) {
        return false;
    }
    if ($stmt->rowCount() <= 0) {
        $stmt = $conn->prepare("INSERT INTO friends
                                VALUES (?, ?, ?, FALSE, NULL, NULL, ?, ?)");
        if (!$stmt->execute(array($id, $nif, $cellphone, $donative_type, $periodicity))) {
            return false;
        }
    }

    // Register the user in the database
    if (!edit_user($id, "Amigo", $email, $name, $gender, $birth)) {
        return false;
    }

    // Register the friend
    $stmt = $conn->prepare("UPDATE friends
                            SET nif = ?, cellphone = ?, donative_type = ?, periodicity = ? WHERE id = ?");
    try {
        return $stmt->execute(array($nif, $cellphone, $donative_type, $periodicity, $id));
    } catch (PDOException $e) {

    }
}


/*short version from the one above*/
function edit_friend_short($id, $name, $birth, $cellphone)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE friends 
                           SET cellphone = ? WHERE id = ?");

    $result = $stmt->execute(array($cellphone, $id));
    if (!$result) {
        return false;
    }

    $stmt = $conn->prepare("UPDATE users
                            SET name = ?, birth = ? 
                            WHERE id = ?");
    try {
        return $stmt->execute(array($name, $birth, $id));
    } catch (PDOException $e) {

    }
}

function edit_friend_payment($id, $payment)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE friends 
                           SET donative_type = ? WHERE id = ?");
    try {
        return $stmt->execute(array($payment, $id));
    } catch (PDOException $e) {

    }
}

function remove_history_entry($id, $type)
{
    global $conn;

    if ($type == 'Evento') {
        $stmt = $conn->prepare("DELETE FROM friend_events 
                                         WHERE event = ?");
    } elseif ($type == 'donative' || $type == 'mercha' || $type == 'eventoPayment') {
        $stmt = $conn->prepare("DELETE FROM payments 
                                         WHERE id = ?");
    } else {
        return false;
    }

    return $stmt->execute(array($id));
}

function edit_payment_event_hist($id, $date, $price, $receipt, $reference)
{

    global $conn;

    $stmt = $conn->prepare("UPDATE payments
                            SET payment_date = ?, value = ?, receipt = ?, atm_reference = ?
                            WHERE id = ?");
    try {
        return $stmt->execute(array($date, $price, $receipt, $reference, $id));
    } catch (PDOException $e) {

    }
}

function edit_donative_hist($id, $date, $price, $receipt, $reference, $pay_method)
{

    global $conn;

    $stmt = $conn->prepare("UPDATE payments
                            SET payment_date = ?, value = ?, receipt = ?, atm_reference = ?
                            WHERE id = ?");
    try {
        return $stmt->execute(array($date, $price, $receipt, $reference, $id));
    } catch (PDOException $e) {

    }

    $stmt = $conn->prepare("UPDATE donatives
                            SET donative_type = ?
                            WHERE id = ?");

    try {
        return $stmt->execute(array($pay_method, $id));
    } catch (PDOException $e) {

    }

}


/**
 *  Edit a user in the database
 * @param id id of the user to be edited
 * @param role role of the user (might be "Contabilista", "Administrador", "Amigo")
 * @param email email of the user, it will be used to login
 * @param name name of the user
 * @param gender gender of the user
 * @param birth birth date of the user
 * @return true if successfull, false otherwise
 */
function edit_user($id, $role, $email, $name, $gender, $birth)
{
    global $conn;

    // Check if previously the user was a friend
    if ($role !== 'Amigo') {
        $stmt = $conn->prepare("SELECT id FROM friends WHERE id = ?");
        if (!$stmt->execute(array($id))) {
            return false;
        }
        if ($stmt->rowCount() > 0) {
            $stmt = $conn->prepare("DELETE FROM friends WHERE id = ?");
            if (!$stmt->execute(array($id))) {
                return false;
            }
        }
    }

    // Update user details
    $stmt = $conn->prepare("UPDATE users SET role = ?, email = ?, name = ?, gender = ?, birth = ? WHERE id = ?");
    try {
        return $stmt->execute(array($role, $email, $name, $gender, $birth, $id));
    } catch (PDOException $e) {

    }
}

/**
 *  Get all the users of the database
 * @return all the users of the database
 */
function get_all_users()
{
    global $conn;
    $stmt = $conn->prepare("SELECT users.id, role, name, email, gender, birth, frozen,
                                    nif, cellphone, donative_type, periodicity
                            FROM users
                            LEFT OUTER JOIN friends
                            ON users.id = friends.id
                            ORDER BY name ASC");
    $stmt->execute();

    $users = $stmt->fetchAll();


    foreach ($users as $key => $user) {
        $user["has_to_pay"] = how_many_month_to_pay($user["id"]);
    }

    return $users;
}

/**
 * Search for a user in the database
 * @param user name of the user to be searched
 * @return results that match the user
 */
function get_search_user_by_name($user)
{
    if ($user === "") {
        return array();
    }

    global $conn;
    $stmt = $conn->prepare("SELECT id, name, birth, role, ts_rank(phrase, query) AS rank
                            FROM users, to_tsquery('portuguese', ?) query, to_tsvector('portuguese', name) phrase
                            WHERE phrase @@ query
                            ORDER BY rank");
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
                          FULL OUTER JOIN mercha_purchases ON mercha_purchases.id = payments.id
                          FULL OUTER JOIN donatives ON donatives.id = payments.id
                          FULL OUTER JOIN friend_events ON friend_events.payment = payments.id
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
 * @param username user's name
 * @param password user's password
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
 * @param email user's username
 * @returns User's role in case of success or false on failure.
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
 * @param email user's username
 * @returns User user entity or false if fail
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

function get_user_by_id($id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT *
                            FROM users
                            WHERE id = ?");
    $stmt->execute(array($id));
    return $stmt->fetch();
}

function edit_credentials($id, $old_name, $new_name, $viewer_name, $old_pw, $new_pw, $confirm_pw) {

    global $conn;

    //update username
    if ($old_name !== $new_name && strlen($new_name) != 0) {
        $result1 = update_credential_username($id, $new_name);

        echo "lol";
        if (!$result1) {
            return false;
        }
    }


    if (strlen($viewer_name) != 0) {
        $stmt = $conn->prepare("UPDATE users
                                SET name = ? 
                                WHERE id = ?");

        if(!$stmt->execute(array($viewer_name, $id)))
            return false;
    }

    if (strlen($old_pw) == 0) return true;

    $stmt = $conn->prepare("SELECT *
                            FROM users
                            WHERE id = ? 
                            AND password = ?");

    $stmt->execute(array($id, hash("sha256", $old_pw)));

    //old pw dont match database pw
    if (!$stmt->fetch()) return false;

    return update_credential_password($id, $new_pw);
}

function update_credential_username($id, $new_name)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE users
                            SET email = ?
                            WHERE id = ?");

    return $stmt->execute(array($new_name, $id));
}

function update_credential_password($id, $new_pw)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE users                            
                            SET password = ?
                            WHERE id = ?");

    return $stmt->execute(array(hash("sha256", $new_pw), $id));
}
/**
 *  Get friends's info (entity) from 2 querries (user + friend)
 * @param username email user's username
 * @returns User friend entity or false if fail
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

    return array_merge($user, $friend[0]);
}

function get_friend_info_by_id($id)
{
    if (($user = get_user_by_id($id)) === false) {
        return false;
    }

    global $conn;
    $stmt = $conn->prepare("SELECT *
                            FROM friends
                            WHERE id = ?");

    $stmt->execute(array($id));
    $friend = $stmt->fetchAll();

    if ($friend === false) {
        return false;
    }

    return array_merge($user, $friend[0]);
}


/**
 *  Get user's s
 * @param id user's id
 * @returns history user's history or false if fail
 */
function get_user_event_history($id)
{
    global $conn;

    $stmt = $conn->prepare("SELECT events.*
    FROM events, friends, friend_events
    WHERE friends.id = ?
    AND friend_events.friend = friends.id
    AND events.id = friend_events.event
    GROUP BY events.id
    ORDER BY events.event_date DESC");

    $stmt->execute(array($id));

    return $stmt->fetchAll();
}

function get_user_event_payments($id)
{
    global $conn;

    $stmt = $conn->prepare("SELECT payments.*, events.name
         FROM payments, friends, friend_events, events
         WHERE friends.id = ?
         AND friend_events.friend = friends.id
         AND friend_events.payment = payments.id
         AND friend_events.event = events.id
         ORDER BY payments.payment_date DESC");

    $stmt->execute(array($id));

    return $stmt->fetchAll();
}

function get_user_donative_history($id)
{
    global $conn;

    $stmt = $conn->prepare("SELECT payments.*, donatives.donative_type
         FROM friends, payments, donatives
         WHERE friends.id = ?
         AND donatives.friend = friends.id
         AND payments.id = donatives.id
         ORDER BY payments.payment_date DESC");

    $stmt->execute(array($id));

    return $stmt->fetchAll();
}

function get_user_merchandise_history($id)
{

    global $conn;

    $stmt = $conn->prepare("SELECT payments.*, mercha_purchases.quantity,
    mercha_products.description, mercha_products.price
    FROM friends, payments, mercha_purchases, mercha_products
    WHERE friends.id = ?
    AND mercha_purchases.friend = friends.id
    AND payments.id = mercha_purchases.id
    AND mercha_purchases.product = mercha_products.id
    ORDER BY payment_date DESC");

    $stmt->execute(array($id));

    return $stmt->fetchAll();
}


/**
 *  Get all users's history (global)
 * @returns hystory global history
 */
/* TODO REDO THIS METHOD */
function get_global_history()
{
    global $conn;

    //get payments history
    $stmt = $conn->prepare(" (
    (SELECT friends.id, payments.id, payments.payment_date AS date,
    payments.payment_type AS type, payments.value AS value
    FROM users, friends, payments, donatives, mercha_purchases
    WHERE friends.id = users.id
    AND(
    (payments.id = donatives.id
    AND donatives.friend = friends.id)
    OR(payments.id = mercha_purchases.id AND
    mercha_purchases.id = payments.id))
    GROUP BY payments.id, friends.id)
    UNION(SELECT friends.id, events.id, events.event_date AS date, 'Evento'
    as type, events.price AS value
    FROM events, payments, friends, friend_events, users
    WHERE events.id = friend_events.event
    AND friend_events.friend = friends.id
    AND users.id = friends.id
    GROUP BY events.id, friends.id))
    ORDER BY date ");

    $stmt->execute();
    return $stmt->fetchAll();
}

/**
 * Add a donative to a user
 * @param {string} $user_id       id of the user of the donative
 * @param {date} $date          date of the donative
 * @param {integer} $atm_reference atm reference of the payment
 * @param {string} $donative_type type of donative
 * @param {double} $value         value of the donative
 * @param {string} $receipt       receipt of the payment
 */
function add_donative($user_id, $date, $atm_reference, $donative_type, $value, $receipt)
{
    global $conn;

    // Insert payment in the database
    $stmt = $conn->prepare("INSERT INTO payments
                            (payment_date, receipt, atm_reference, value, payment_type)
                            VALUES (?, ?, ?, ?, 'Donativo') RETURNING id");
    if (!$stmt->execute(array($date, $receipt, $atm_reference, $value))) {
        return false;
    }
    $payment_id = $stmt->fetch()['id'];

    // Insert donative
    $stmt = $conn->prepare("INSERT INTO donatives (id, friend, donative_type)
                            VALUES (?, ?, ?)");
    if (!$stmt->execute(array($payment_id, $user_id, $donative_type))) {
        $stmt = $conn->prepare("DELETE FROM payments
                                WHERE id = ?");
        $stmt->execute(array($payment_id));
        return false;
    }
    return true;
}

function how_many_month_to_pay($id)
{
    global $conn;
    $stmt = $conn->prepare("select last_donative, periodicity, frozen from friends where id = ?");
    $stmt->execute(array($id));

    $result = $stmt->fetchAll();

    $last_donative = $result[0]["last_donative"];
    $periodicity = $result[0]["periodicity"];
    $frozen = $result[0]["frozen"];


    if(!$frozen){
        $currentDate = new DateTime();
        $last_donative = new DateTime($last_donative);
        $diff = $last_donative->diff($currentDate);
        $diff=$diff->format("%R%a");

        if($periodicity === 'Mensal' && $diff >= 30 ){
            return floor($diff/30);
        }
        else if($periodicity === 'Trimestral' && $diff >= 90){
            return floor($diff/90);
        }
        else if($periodicity === 'Semestral' && $diff >= 180){
            return floor($diff/180);
        }
        else if($periodicity === 'Anual' && $diff >= 365){
            return floor($diff/365);
        }
    }

    return 0;
}