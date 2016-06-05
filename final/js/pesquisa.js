/*global $ */

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
 * Configure the elements
 */
function config() {
    // Manage users
    $('i[data-original-title="Ver"]').click(configSeeEventModal);
}

/**
 * On document ready
 */
$(document).ready(config);
