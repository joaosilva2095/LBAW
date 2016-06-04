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
    return $stmt->fetchAll();
}

/**
 * Add a friend to a event
 * @param  {integer} $eventId   id of the event
 * @param  {integer} $userId    if of the user to be added to the event
 * @param  {integer} $paymentId id of the user's event payment
 * @return {boolean} true if successful, false otherwise
 */
function add_friend_event($eventId, $userId, $paymentId)
{
    global $conn;

    if($paymentId === '') {
        $stmt = $conn->prepare("INSERT INTO friend_events (event, friend)
                            VALUES (?, ?)");
        return $stmt->execute(array($eventId, $userId));
    } else {
        $stmt = $conn->prepare("INSERT INTO friend_events (event, friend, payment)
                            VALUES (?, ?, ?)");
        return $stmt->execute(array($eventId, $userId, $paymentId));
    }
}
