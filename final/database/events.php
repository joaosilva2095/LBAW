<?php

/**
 * Register a event in the database
 * @param  {string} $name        name of the event
 * @param  {string} $description description of the event
 * @param  {date} $date        date of the event
 * @param  {integer} $duration    duration of the event
 * @param  {string} $place       place of the event
 * @param  {real} $price       price of the event
 * @return integer  id of the event if successful, false otherwise
 */
function register_event($name, $description, $date, $duration, $place, $price)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO events (name, description, event_date, duration, place, price)
                            VALUES (?, ?, ?, ?, ?, ?) RETURNING id");
    if (!$stmt->execute(array($name, $description, $date, $duration, $place, $price))) {
        return false;
    }
    return $stmt->fetch();
}

/**
 *  Remove a user from the database
 *
 * @param $event_id id of the user to remove
 * @return true if successfull, false otherwise
 */
function remove_event($event_id)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM events
                            WHERE id = ?");
    return $stmt->execute(array($event_id));
}

/**
 * Edit a event in the database
 * @param  {integer} $event_id        id of the event
 * @param  {string} $name        name of the event
 * @param  {string} $description description of the event
 * @param  {date} $date        date of the event
 * @param  {integer} $duration    duration of the event
 * @param  {string} $place       place of the event
 * @param  {real} $price       price of the event
 * @return boolean  true if successful, false otherwise
 */
function edit_event($event_id, $name, $description, $date, $duration, $place, $price)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE events SET
                            name = ?, description = ?, event_date = ?,
                            duration = ?, place = ?, price = ?
                            WHERE id = ?");
    return $stmt->execute(array($name, $description, $date, $duration, $place, $price, $event_id));
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
    $events = $stmt->fetchAll();
    foreach ($events as $key => $event) {
        $events[$key]['friends'] = get_all_event_friends($event['id']);
    }
    return $events;
}

/**
 * Get all the friends that went to a event
 * @param  {integer} $event_id id of the event to get all the friends
 * @return {array} array with all the friends that went to that event
 */
function get_all_event_friends($event_id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT users.id, users.name
                            FROM friend_events
                            JOIN users ON friend_events.friend = users.id
                            WHERE friend_events.event = ?
                            ORDER BY users.name ASC");
    $stmt->execute(array($event_id));
    return $stmt->fetchAll();
}

/**
 * Add a friend to a event
 * @param  {integer} $event_id      id of the event to add the friend
 * @param  {string} $user_id       id of the user to be added
 * @param  {date} $payment_date  date of the payment of the event
 * @param  {integer} $atm_reference atm reference for the payment
 * @param  {double} $payment_value value of the event payment
 * @param  {string} $receipt       receipt hash file
 * @return boolean  true if successful, false otherwise
 */
function add_friend_event($event_id, $user_id, $payment_date, $atm_reference, $payment_value, $receipt)
{
    global $conn;

    // Insert payment in the database
    $stmt = $conn->prepare("INSERT INTO payments
                            (payment_date, receipt, atm_reference, value, payment_type)
                            VALUES (?, ?, ?, ?, 'Pagamento Evento') RETURNING id");
    if (!$stmt->execute(array($payment_date, $receipt, $atm_reference, $payment_value))) {
        return false;
    }
    $payment_id = $stmt->fetch()['id'];

    // Insert friend attendance
    $stmt = $conn->prepare("INSERT INTO friend_events (event, friend, payment)
                            VALUES (?, ?, ?)");
    if (!$stmt->execute(array($event_id, $user_id, $payment_id))) {
        $stmt = $conn->prepare("DELETE FROM payments
                                WHERE id = ?");
        $stmt->execute(array($payment_id));
        return false;
    }
    return true;
}

/**
 * Add a friend to a free event
 * @param  {integer} $event_id      id of the event to add the friend
 * @param  {string} $user_id       id of the user to be added
 * @param  {date} $payment_date  date of the payment of the event
 * @param  {integer} $atm_reference atm reference for the payment
 * @param  {double} $payment_value value of the event payment
 * @param  {string} $receipt       receipt hash file
 * @return boolean  true if successful, false otherwise
 */
function add_friend_free_event($event_id, $user_id)
{
    global $conn;

    // Insert friend attendance
    $stmt = $conn->prepare("INSERT INTO friend_events (event, friend)
                            VALUES (?, ?)");
    return $stmt->execute(array($event_id, $user_id));
}

/**
 *  Remove a user event from the database
 *
 * @param {integer} $event_id id of the event to get the user removed
 * @param {string}  $user_id id of the user to be removed from the event
 * @return true if successfull, false otherwise
 */
function remove_friend_event($event_id, $user_id)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM friend_events
                            WHERE event = ? AND friend = ?");
    return $stmt->execute(array($event_id, $user_id));
}
