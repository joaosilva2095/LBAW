/*global $ */

/**
 * Remove a event from the database
 * @param {integer} id id of the event to be removed
 */
function removeEvent(id) {
    // Async call to remove event
    $.post(
            "../api/delete_event.php", {
                id: id
            },
            function (data, statusText, xhr) {
                if (data === '') {
                    $('#event' + id).remove();
                } else {
                    $('#event' + id).highlightAnimation(red, 1500);
                }
            })
        .fail(function (error) {
            $('#event' + id).highlightAnimation(red, 1500);
        });
}

/**
 * Remove a friend from a event
 * @param {integer} eventId id of the event
 * @param {integer} userId id of the friend to remove from the event
 */
function removeEventFriend(eventId, userId) {
    // Async call to remove event
    $.post(
            "../api/delete_friend_event.php", {
                eventId: eventId,
                userId: userId
            },
            function (data, statusText, xhr) {
                if (data === '') {
                    $('#seeEventModal').modal('hide');
                    $('#eventFriend' + eventId + "-" + userId).remove();
                } else {
                    $('#eventFriend' + eventId + "-" + userId).highlightAnimation(red, 1500);
                }
            })
        .fail(function (error) {
            $('#eventFriend' + eventId + "-" + userId).highlightAnimation(red, 1500);
        });
}

/**
 * Confirm remove event
 */
function confirmRemoveEvent() {
    // Variables
    var id = $(this).closest('tr').attr('id');
    id = id.replace("event", "");

    $('#confirm').modal({
            backdrop: 'static',
            keyboard: false
        })
        .one('click', '#delete', function () {
            removeEvent(id);
        });
}

/**
 * Confirm remove event
 */
function confirmRemoveEventFriend() {
    // Variables
    var eventFriend = $(this).closest('tr').attr('id'),
        split = eventFriend.split("-"),
        eventId = split[0].replace("eventFriend", ""),
        userId = split[1];

    $('#confirm').modal({
            backdrop: 'static',
            keyboard: false
        })
        .one('click', '#delete', function () {
            removeEventFriend(eventId, userId);
        });
}
/**
 * Configuration of the edit event modal
 */
function configEditEventModal() {
    $('#addEventModal form').trigger('reset');
    $('#addEventModalTitle').html('Editar Evento');

    // Fill data
    var id = $(this).closest('tr').attr('id');
    id = id.replace("event", "");

    var description = $("#event" + id + " td:nth-child(1)").text(),
        name = $("#event" + id + " td:nth-child(2)").text(),
        date = $("#event" + id + " td:nth-child(3)").text(),
        duration = $("#event" + id + " td:nth-child(4)").text(),
        place = $("#event" + id + " td:nth-child(5)").text(),
        price = $("#event" + id + " td:nth-child(6)").text();

    // Set form
    $('#id').val(id);
    $('#name').val(name);
    $('#description').val(description);
    $('#date').val(date);
    $('#duration').val(duration);
    $('#place').val(place);
    $('#price').val(price);
}

/**
 * Configuration of the see event modal
 */
function configSeeEventModal() {
    $('#seeEventModal form').trigger('reset');

    // Fill data
    var id = $(this).closest('tr').attr('id');
    id = id.replace("event", "");

    var description = $("#event" + id + " > td:nth-child(1)").text(),
        name = $("#event" + id + " > td:nth-child(2)").text(),
        friends = $("#event" + id + " td:nth-child(8)").html();

    // Set form
    $('#seeEventName').val(name);
    $('#seeEventDescription').val(description);
    $('#seeEventFriends').html(friends);

    enableTooltips();
    $('i[data-original-title="Eliminar Presença"]').click(confirmRemoveEventFriend);
}


/**
 * Configuration of the new event modal
 */
function configNewFriendEventModal() {
    $('#addUserAttendanceEventModal form').trigger('reset');

    // Fill data
    var id = $(this).closest('tr').attr('id');
    id = id.replace("event", "");

    // Set form
    $('#attendanceEventId').val(id);

    $('#addUserAttendanceEventModalTitle').html('Adicionar Presença');
}

/**
 * Configure the elements
 */
function config() {
    // Manage users
    $('i[data-original-title="Ver"]').click(configSeeEventModal);
    $('i[data-original-title="Adicionar Presença"]').click(configNewFriendEventModal);
    $('i[data-original-title="Editar"]').click(configEditEventModal);
    $('i[data-original-title="Eliminar"]').click(confirmRemoveEvent);
}

/**
 * On document ready
 */
$(document).ready(config);
