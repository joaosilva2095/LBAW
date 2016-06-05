/*global $ */

/**
 * Function to register attendance of a friend in a event
 */
function registerFriendEvent() {
    // Variables
    var formData = new FormData(),
        eventId = $('#attendanceEventId').val(),
        userId = $('#attendanceUserId').val(),
        paymentDate = $('#attendancePaymentDate').val(),
        paymentATMReference = $('#attendancePaymentATMReference').val(),
        paymentValue = $('#attendancePaymentValue').val();

    formData.append('eventId', eventId);
    formData.append('userId', userId);
    formData.append('paymentDate', paymentDate);
    formData.append('paymentATMReference', paymentATMReference);
    formData.append('paymentValue', paymentValue);
    formData.append('file', $('#attendancePaymentReceipt')[0].files[0]);

    // Async call to add friend event
    $.ajax({
        url: "../api/add_friend_event.php",
        data: formData,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (data, statusText, xhr) {
            if (data === '') {
                $('#addUserAttendanceEventModal').modal('hide');

                $('#event' + eventId).highlightAnimation(green, 1500);
            } else {
                $('#addUserAttendanceEventStatus').fadeIn();
            }
        }
    }).fail(function (error) {
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
