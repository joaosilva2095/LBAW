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
    var username = $('#meEmail').text();
    $('#editCredentialsFormName').val(username);

    var contentNameNav = $("#UserNameNav").text();
    var roleContentNav = contentNameNav.substring(contentNameNav.indexOf('('), contentNameNav.length);
    var nameContentNav = contentNameNav.substring(0, contentNameNav.indexOf('(') - 1);

    if (roleContentNav != 'Amigo') {
        $('#editCredentialsFormViewerName').val(nameContentNav);
        console.log(contentNameNav);
    }
}


function editCredentials(id, old_name) {

    var form_name = $('#editCredentialsFormName').val(),
        form_old_pw = $('#editCredentialsFormOldPw').val(),
        form_new_pw = $('#editCredentialsFormNewPw').val(),
        form_confirm_pw = $('#editCredentialsFormConfirmPw').val();

    var contentNameNav = $("#UserNameNav").text();
    var roleContentNav = contentNameNav.substring(contentNameNav.indexOf('(')+1, contentNameNav.length-1);
    var nameContentNav = contentNameNav.substring(0, contentNameNav.indexOf('(') - 1);
    //viewer_name = email (contabilsita/admin)
    var viewer_new_name = "";
    if (roleContentNav !== 'Amigo') {
        viewer_new_name = $('#editCredentialsFormViewerName').val();
    }
    //form vazio
    if ((form_name === old_name ||
        form_name.length == 0) &&
       (viewer_new_name.length == 0 || nameContentNav === viewer_new_name) 
        && form_old_pw.length == 0) {
        $('#editCredentialsModal').modal('hide');
        return true;
    }

    //checks
    if (form_old_pw.length != 0) {
        if (form_new_pw.length == 0 ||
            form_confirm_pw.length == 0 ||
            form_new_pw == form_old_pw ||
            form_new_pw !== form_confirm_pw) {
            $('#UserStatus1').fadeIn();
            return false;
        }
    }
    else {
        if (form_new_pw.length != 0 || form_confirm_pw.length != 0) {
            $('#UserStatus1').fadeIn();
            return false;
        }
    }

    $.post(
        "../api/edit_credentials.php", {
            id: id,
            old_name: old_name,
            new_name: form_name,
            viewer_new_name: viewer_new_name, //nome 
            old_pw: form_old_pw,
            new_pw: form_new_pw,
            confirm_pw: form_confirm_pw
        },
        function (data, statusText, xhr) {
            
            if (roleContentNav != 'Amigo') {
                if (viewer_new_name !== undefined && viewer_new_name.length != 0)
                    $("#UserNameNav").html(viewer_new_name + " " + roleContentNav);                    
            }
            else {
                $("#UserEmail").html(form_name);
            }
            //console.log(data);                    

            $('#UserStatus2').fadeIn(1000);
            setTimeout(function () {
                $('#editCredentialsModal').modal('hide');
            }, 1500);
            $('#UserStatus2').fadeOut();

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

    $('#navsettings a').click(function (event) {
        $(this).parent().toggleClass('open');
    });

}

/**
 * On document ready
 */
$(document).ready(config);
