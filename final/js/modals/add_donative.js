/*global $ */

/**
 * Function to register a friend donative
 */
function registerDonative() {
    // Variables
    var formData = new FormData(),
        userId = $('#addDonativeUserId').val(),
        date = $('#addDonativeDate').val(),
        atmReference = $('#addDonativeATMReference').val(),
        donativeType = $('#addDonativeType').val(),
        value = $('#addDonativeValue').val();

    formData.append('userId', userId);
    formData.append('date', date);
    formData.append('atmReference', atmReference);
    formData.append('donativeType', donativeType);
    formData.append('value', value);
    formData.append('file', $('#addDonativeReceipt')[0].files[0]);

    // Async call to add friend event
    $.ajax({
        url: "../api/add_donative.php",
        data: formData,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (data, statusText, xhr) {
            if (data === '') {
                $('#addDonativeModal').modal('hide');

                $('#user' + userId).highlightAnimation(green, 1500);
            } else {
                $('#addDonativeStatus').fadeIn();
            }
        }
    }).fail(function (error) {
        $('#addDonativeStatus').fadeIn();
    });
}

/**
 * Configure the elements
 */
function config() {
    $('#addDonativeForm').submit(function (e) {
        e.preventDefault();
        registerDonative();
    });

    $('#addDonativeStatus').click(function () {
        $(this).fadeOut();
    });
}

/**
 * On document ready
 */
$(document).ready(config);
