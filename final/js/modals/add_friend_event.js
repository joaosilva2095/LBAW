/*global $ */

/**
 * Function to register attendance of a friend in a event
 */
function registerFriendEvent() {
    // Variables
    var eventId = $('#attendanceEventId').val(),
        userId = $('#attendanceUserId').val(),
        paymentId = $('#attendancePaymentId').val();

    // Async call to add friend event
    $.post(
            "../api/add_friend_event.php", {
                eventId: eventId,
                userId: userId,
                paymentId: paymentId
            },
            function (data, statusText, xhr) {
                if (data === '') {
                    $('#addUserAttendanceEventModal').modal('hide');

                    $('#event' + eventId).highlightAnimation(green, 1500);
                } else {
                    $('#addUserAttendanceEventStatus').fadeIn();
                }
            })
        .fail(function (error) {
            $('#addUserAttendanceEventStatus').fadeIn();
        });
}

/**
 * Configure the elements
 */
function config() {
    $('#addUserAttendanceEventForm').submit(function (e) {
        e.preventDefault();
        registerFriendEvent();
    });

    $('#addUserAttendanceEventStatus').click(function () {
        $(this).fadeOut();
    });
}

/**
 * On document ready
 */
$(document).ready(config);
