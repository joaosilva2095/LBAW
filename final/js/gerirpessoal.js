// Used colors
var green = '#DFF0D8';
var red = '#A94442';

/**
 * Function to register a user
 */
function registerUser() {
    // Variables
    var id = $('#identification').val();
    var role = $('#role').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var name = $('#name').val();
    var gender = $('#gender').val();
    var birth = $('#birthdate').val();

    // Friend only
    var nif = $('#nif').val();
    var cellphone = $('#cellphone').val();
    var donativeType = $('#paymethod').val();
    var periodicity = $('#periodicity').val();
    if (role != 'Amigo') {
        nif = " ";
        cellphone = " ";
        donativeType = " ";
        periodicity = " ";
    }

    // Async call to register
    $.post(
            "../api/register_user.php", {
                id: id,
                role: role,
                email: email,
                password: password,
                name: name,
                gender: gender,
                birth: birth,
                nif: nif,
                cellphone: cellphone,
                donative_type: donativeType,
                periodicity: periodicity
            },
            function(data, statusText, xhr) {
                $('#userModal').modal('hide');

                var tr = $('#users tr:last');
                var trNew = tr.clone();
                trNew.attr("id", "user" + id);
                tr.after(trNew);

                $("#user" + id + " td:nth-child(1)").html(id);
                $("#user" + id + " td:nth-child(2)").html(name);
                $("#user" + id + " td:nth-child(3)").html(email);
                $("#user" + id + " td:nth-child(4)").html(gender);
                $("#user" + id + " td:nth-child(5)").html(birth);
                $("#user" + id + " td:nth-child(6)").html(cellphone);
                $("#user" + id + " td:nth-child(7)").html(nif);
                $("#user" + id + " td:nth-child(8)").html(donativeType);
                $("#user" + id + " td:nth-child(9)").html(periodicity);
                $("#user" + id + " td:nth-child(10)").html(role);

                trNew.highlightAnimation(green, 1500);

                // Update listeners
                $('i[data-original-title="Eliminar"]').click(removeUser);
                enableTooltips();
            })
        .fail(function(error) {
            $('#userStatus').fadeIn();
        });
}

/**
 * Remove a user from the database
 */
function removeUser() {
    // Variables
    var id = $(this).closest('tr').attr('id');
    id = id.replace("user", "");

    // Async call to login
    $.post(
            "../api/delete_user.php", {
                id: id
            },
            function(data, statusText, xhr) {
                $('#user' + id).remove();
            })
        .fail(function(error) {
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
            function(data, statusText, xhr) {
                var userRow = $('#user' + id);
                var userFrozenIcon = $('#user' + id + "-frozen");
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
        .fail(function(error) {
            $('#user' + id).highlightAnimation(red, 1500);
        });
}

/**
 * Update user in the database
 */
function updateUser() {
    // Variables
    var id = $('#identification').val();
    var role = $('#role').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var name = $('#name').val();
    var gender = $('#gender').val();
    var birth = $('#birthdate').val();

    // Friend only
    var nif = $('#nif').val();
    var cellphone = $('#cellphone').val();
    var donativeType = $('#paymethod').val();
    var periodicity = $('#periodicity').val();
    if (role != 'Amigo') {
        nif = " ";
        cellphone = " ";
        donativeType = " ";
        periodicity = " ";
    }

    // Async call to edit
    $.post(
            "../api/edit_user.php", {
                id: id,
                role: role,
                email: email,
                name: name,
                gender: gender,
                birth: birth,
                nif: nif,
                cellphone: cellphone,
                donative_type: donativeType,
                periodicity: periodicity
            },
            function(data, statusText, xhr) {
                $('#userModal').modal('hide');

                $("#user" + id + " td:nth-child(1)").html(id);
                $("#user" + id + " td:nth-child(2)").html(name);
                $("#user" + id + " td:nth-child(3)").html(email);
                $("#user" + id + " td:nth-child(4)").html(gender);
                $("#user" + id + " td:nth-child(5)").html(birth);
                $("#user" + id + " td:nth-child(6)").html(cellphone);
                $("#user" + id + " td:nth-child(7)").html(nif);
                $("#user" + id + " td:nth-child(8)").html(donativeType);
                $("#user" + id + " td:nth-child(9)").html(periodicity);
                $("#user" + id + " td:nth-child(10)").html(role);

                $('#user' + id).highlightAnimation(green, 1500);
            })
        .fail(function(error) {
            $('#userStatus').fadeIn();
        });
}

/**
 * Enable the tooltips
 */
function enableTooltips() {
    $('[data-toggle="tooltip"]').tooltip({
        placement: 'top'
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
 * Configuration of the new user modal
 */
function configNewUserModal() {
    $('#userModal form').trigger('reset');

    $('#friendOnlyParams').fadeIn();
    $('label[for="password"]').show();
    $('#password').show();
    $('#identification').removeAttr('disabled');

    $('#userModalTitle').html('Novo Utilizador');
}

/**
 * Animate a element with a color
 * @param highlightColor color to highlight
 * @param duration duration of the animation
 */
$.fn.highlightAnimation = function(highlightColor, duration) {
    var highlightBg = highlightColor || "#DFF0D8";
    var animateMs = duration || 1500;
    var originalBg = this.css("background-color");
    this.stop().css("background-color", highlightBg)
        .animate({
            backgroundColor: originalBg
        }, animateMs);
};

/**
 * On document ready
 */
$(document).ready(function() {
    enableTooltips();

    $('#newUser').click(configNewUserModal);
    $('#userSubmit').click(function() {
        if ($('#userModalTitle').text() == 'Novo Utilizador')
            registerUser();
        else
            updateUser();
    });

    $('i[data-original-title="Editar"]').click(configEditUserModal);
    $('i[data-original-title="Eliminar"]').click(removeUser);
    $('i[data-original-title="Congelar"]').click(togglePauseUser);
    $('i[data-original-title="Descongelar"]').click(togglePauseUser);

    $('#userStatus').click(function() {
        $(this).fadeOut();
    });

    $('#role').change(function() {
        var role = $('#role').val();
        if (role === 'Amigo') {
            $('#friendOnlyParams').fadeIn();
        } else {
            $('#friendOnlyParams').fadeOut();
        }
    });
});
