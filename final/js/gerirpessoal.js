/*global $ */

/**
 * Remove a user from the database
 * @param {string} id id of the user to be removed
 */
function removeUser(id) {
    // Async call to login
    $.post(
            "../api/delete_user.php", {
                id: id
            },
            function (data, statusText, xhr) {
                $('#user' + id).remove();
            })
        .fail(function (error) {
            $('#user' + id).highlightAnimation(red, 1500);
        });
}

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
 * Confirm remove user
 */
function confirmRemoveUser() {
    // Variables
    var id = $(this).closest('tr').attr('id');
    id = id.replace("user", "");

    $('#confirm').modal({
            backdrop: 'static',
            keyboard: false
        })
        .one('click', '#delete', function () {
            removeUser(id);
        });
}

/**
 * Configuration of the edit user modal
 */
function configEditUserModal() {
    $('#addUserModal form').trigger('reset');
    $('#addUserModalTitle').html('Editar Utilizador');

    // Fill data
    var id = $(this).closest('tr').attr('id');
    id = id.replace("user", "");

    // Variables
    var name = $("#user" + id + " td:nth-child(2)").text();
    var email = $("#user" + id + " td:nth-child(3)").text();
    var gender = $("#user" + id + " td:nth-child(4)").text();
    var birth = $("#user" + id + " td:nth-child(5)").text();
    var cellphone = $("#user" + id + " td:nth-child(6)").text();
    var nif = $("#user" + id + " td:nth-child(7)").text();
    var donativeType = $("#user" + id + " td:nth-child(8)").text();
    var periodicity = $("#user" + id + " td:nth-child(9)").text();
    var role = $("#user" + id + " td:nth-child(10)").text();

    // Hide or show parameters
    $('label[for="password"]').hide();
    $('#password').removeAttr("required");
    $('#password').hide();
    if (role == 'Amigo')
        $('#friendOnlyParams').show();
    else
        $('#friendOnlyParams').hide();

    // Disable fields
    $('#identification').attr('disabled', 'disabled');

    // Set form
    $('#identification').val(id);
    $('#name').val(name);
    $('#email').val(email);
    $('#gender').val(gender);
    $('#birthdate').val(birth);
    $('#role').val(role);
    $('#nif').val(nif);
    $('#cellphone').val(cellphone);
    $('#paymethod').val(donativeType);
    $('#periodicity').val(periodicity);

    $('#role').trigger('change');
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
 * Configuration of the add donative modal
 */
function configAddDonativeModal() {
    $('#addDonativeForm form').trigger('reset');

    // Fill data
    var id = $(this).closest('tr').attr('id');
    id = id.replace("user", "");

    var name = $("#user" + id + " td:nth-child(2)").text(),
        donativeType = $("#user" + id + " > td:nth-child(8)").text();

    // Set form
    $('#addDonativeUserId').val(id);
    $('#addDonativeName').val(name);
    $('#addDonativeType').val(donativeType);
}

/**
 * Configure the elements
 */
function config() {
    // Manage users
    $('i[data-original-title="Editar"]').click(configEditUserModal);
    $('i[data-original-title="Eliminar"]').click(confirmRemoveUser);
    $('i[data-original-title="Adicionar Donativo"]').click(configAddDonativeModal);
    $('i[data-original-title="Congelar"]').click(togglePauseUser);
    $('i[data-original-title="Descongelar"]').click(togglePauseUser);
    $('i[data-original-title="Notificar"]').click(configAddNotificationModal);
}

/**
 * On document ready
 */
$(document).ready(config);
