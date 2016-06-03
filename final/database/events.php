<?php

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
function register_event($id, $role, $email, $password, $name, $gender, $birth)
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
 * @param id id of the user to remove
 * @return true if successfull, false otherwise
 */
function remove_event($id)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM users
                            WHERE id = ?");
    return $stmt->execute(array($id));
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
function edit_event($id, $role, $email, $name, $gender, $birth)
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
function get_all_events()
{
    global $conn;
    $stmt = $conn->prepare("SELECT id, event_date, name, description, duration, place, price
                            FROM events
                            ORDER BY event_date ASC");
    $stmt->execute();
    return $stmt->fetchAll();
}
