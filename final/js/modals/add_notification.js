/*global $ */

/**
 * Function to register a user
 */
function addUserNotification() {
    // Variables
    var id = $('#notificationUserId').val(),
        message = $('#notificationMessage').val(),
        type = $('#notificationType').val();

    // Async call to register
    $.post(
            "../api/add_notification.php", {
                id: id,
                message: message,
                type: type
            },
            function (data, statusText, xhr) {
                if (data === '') {
                    $('#notificationModal').modal('hide');

                    $('#user' + id).highlightAnimation(green, 1500);
                } else {
                    $('#notificationStatus').fadeIn();
                }
            })
        .fail(function (error) {
            $('#notificationStatus').fadeIn();
        });
}

/**
 * Configure the elements
 */
function config() {
    $('#notificationForm').submit(function (e) {
        e.preventDefault();
        addUserNotification();
    });

    $('#notificationStatus').click(function () {
        $(this).fadeOut();
    });
}

/**
 * On document ready
 */
$(document).ready(config);
