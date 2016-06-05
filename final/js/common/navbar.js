/*global $ */

/**
 * Mark a notification as seen
 */
function markNotification() {
    var id = $(this).attr('id');
    id = id.replace("notification", "");

    // Async call to mark notification
    $.post(
        "../api/mark_notification.php", {
            id: id
        },
        function (data, statusText, xhr) {
            $('#notification' + id).remove();
            var badges = $('#notifications .badge');
            badges.html(parseInt(badges.html()) - 1);
        })
        .fail(function (error) {
            $('#notification' + id).highlightAnimation(red, 1500);
        });
}


function prepareEditCredentialsModal() {
    var username = $('#UserEmail').text();
    $('#editCredentialsFormName').val(username);
}

function editCredentials(id, old_name) {

    var form_name = $('#editCredentialsFormName').val(),
        form_old_pw = $('#editCredentialsFormOldPw').val(),
        form_new_pw = $('#editCredentialsFormNewPw').val(),
        form_confirm_pw = $('#editCredentialsFormConfirmPw').val();

    console.log(old_name, form_name, form_old_pw, form_new_pw, form_confirm_pw);

    //nao existem modificacoes
    if ((form_name === old_name || form_name.length == 0) && form_old_pw.length == 0) {
        $('#editCredentialsModal').modal('hide');
        return true;
    }

    //checks
    if (form_old_pw.length != 0) {
        if (form_new_pw.length == 0 || form_confirm_pw.length == 0 || form_new_pw !== form_confirm_pw) {
            $('#editCredentialsFormNewPw').highlightAnimation(red, 1500);
            $('#editCredentialsFormConfirmPw').highlightAnimation(red, 1500);
            return false;
        }
    }
    else {
        if (form_new_pw.length != 0 || form_new_pw.length != 0) {
            $('#editCredentialsFormNewPw').highlightAnimation(red, 1500);
            $('#editCredentialsFormConfirmPw').highlightAnimation(red, 1500);
            return false;
        }
    }

    $.post(
        "../api/edit_credentials.php", {
            id: id,
            old_name: old_name,
            new_name: form_name,
            old_pw: form_old_pw,
            new_pw: form_new_pw,
            confirm_pw: form_confirm_pw
        },
        function (data, statusText, xhr) {
            $('#editCredentialsModal').modal('hide');

            $("#UserEmail").html(new_name);
        })
        .fail(function (error) {
            console.log(error);
            $('#UserStatus1').fadeIn();
        });
}


/**
 * Configure the elements
 */
function config() {
    // Dropdown toggler
    $('#notifications a').click(function (event) {
        $(this).parent().toggleClass('open');
    });

    $('body').click(function (e) {
        if (!$('#notifications').is(e.target) && $('#notifications').has(e.target).length === 0 && $('.open').has(e.target).length === 0) {
            $('#notifications').removeClass('open');
        }
    });

    $('#notifications li').click(markNotification);

    $('#EditCredentials').click(prepareEditCredentialsModal);
    
    $('#settings a').click(function (event) {
        $(this).parent().toggleClass('open');
    });

}

/**
 * On document ready
 */
$(document).ready(config);
