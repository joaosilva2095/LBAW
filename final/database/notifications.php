<?php

/**
 * Get the unread user notifications
 * @param  {string} $user_id id of the user to get the notifications
 * @return {boolean} true if successful, false otherwise
 */
function get_user_notifications($user_id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM get_unread_notifications(?)");
    $stmt->execute(array($user_id));
    return $stmt->fetchAll();
}

/**
 * Add a web notification to a user
 * @param  {string} $user_id           id of the user to add the notification
 * @param  {string} $description       description of the notification
 * @param  {string} $notification_type type of the notification (Success, Info, Warning, Danger)
 * @return {boolean} true if successful, false otherwise
 */
function add_notification($user_id, $description, $notification_type)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO web_notifications (user_id, description, notification_type)
                            VALUES (?, ?, ?)");
    return $stmt->execute(array($user_id, $description, $notification_type));
}
