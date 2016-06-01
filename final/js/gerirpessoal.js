// Used colors
var green = '#DFF0D8';
var red = '#A94442';

/**
 * Function to register / update a user
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

    // Async call to login
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
                $("#user" + id + " td:nth-child(3)").html(birth);
                $("#user" + id + " td:nth-child(4)").html(role);

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
 * Enable the tooltips
 */
function enableTooltips() {
    $('[data-toggle="tooltip"]').tooltip({
        placement: 'top'
    });
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

    $('#newUser').click(function() {
        $('#userModal form').trigger('reset');
        $('#friendOnlyParams').fadeIn();
        $('#userModalTitle').html('Novo Utilizador');
    });
    $('#userSubmit').click(updateUser);

    $('i[data-original-title="Editar"]').click(function() {
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

        if (role == 'Amigo')
            $('#friendOnlyParams').fadeIn();
        else
            $('#friendOnlyParams').fadeOut();

        // Set form
        $('#identification').val(id);
        $('#name').val(name);
        $('#email').val(email);
        $('#gender').val(gender);
        $('#birthdate').val(birthdate);
        $('#role').val(role);
        $('#nif').val(nif);
        $('#cellphone').val(cellphone);
        $('#paymethod').val(donativeType);
        $('#periodicity').val(periodicity);
    });
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
