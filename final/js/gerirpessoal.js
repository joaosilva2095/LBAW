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
 * Configuration of the edit user modal
 */
function configEditUserModal() {
    $('#userModal form').trigger('reset');
    $('#userModalTitle').html('Editar Utilizador');

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
}

/**
 * Configuration of the add notification modal
 */
function configAddNotificationModal() {
    // Fill data
    var id = $(this).closest('tr').attr('id');
    id = id.replace("user", "");

    $('#notificationUserId').val(id);
}

/**
 * On document ready
 */
$(document).ready(function () {
    enableTooltips();

    // Manage users
    $('i[data-original-title="Editar"]').click(configEditUserModal);
    $('i[data-original-title="Eliminar"]').click(removeUser);
    $('i[data-original-title="Congelar"]').click(togglePauseUser);
    $('i[data-original-title="Descongelar"]').click(togglePauseUser);
    $('i[data-original-title="Notificar"]').click(configAddNotificationModal);
});
