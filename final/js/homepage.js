/*global $ */

/**
 * Toggle pause a user from the database
 */
function togglePauseUser() {
    // Variables
    var id = $(this).closest('tr').attr('id');
    id = id.replace("user", "");

    // Async call to login
    $.post(
        "../api/pause_user.php", {
            id: id
        },
        function (data, statusText, xhr) {
            var userRow = $('#user' + id),
                userFrozenIcon = $('#user' + id + "-frozen");
            if (userRow.hasClass('warning')) {
                userRow.removeClass('warning');
                userFrozenIcon.removeClass('fa-play');
                userFrozenIcon.addClass('fa-pause');
                userFrozenIcon.tooltip('hide')
                    .attr('data-original-title', 'Congelar')
                    .tooltip('fixTitle');
            } else {
                userRow.addClass('warning');
                userFrozenIcon.removeClass('fa-pause');
                userFrozenIcon.addClass('fa-play');
                userFrozenIcon.tooltip('hide')
                    .attr('data-original-title', 'Descongelar')
                    .tooltip('fixTitle');
            }
        })
        .fail(function (error) {
            $('#user' + id).highlightAnimation(red, 1500);
        });
}

/**
 * Configuration of the add notification modal
 */
function configAddNotificationModal() {
    // Fill data
    var id = $(this).closest('tr').attr('id');
    id = id.replace("user", "");

    var name = $("#user" + id + " td:nth-child(2)").text();

    $('#notificationUserId').val(id);
    $('#notificationName').val(name);
}

/**
 * Configure the elements
 */
function config() {
    // Manage users
    $('i[data-original-title="Congelar"]').click(togglePauseUser);
    $('i[data-original-title="Descongelar"]').click(togglePauseUser);
    $('i[data-original-title="Notificar"]').click(configAddNotificationModal);
}


/**
 * On document ready
 */
$(document).ready(config);


