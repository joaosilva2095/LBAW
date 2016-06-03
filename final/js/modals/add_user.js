/*global $ */

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
            function (data, statusText, xhr) {
                $('#user' + id).remove();
            })
        .fail(function (error) {
            $('#user' + id).highlightAnimation(red, 1500);
        });
}

/**
 * Function to register a user
 */
function registerUser() {
    // Variables
    var id = $('#identification').val(),
        role = $('#role').val(),
        email = $('#email').val(),
        password = $('#password').val(),
        name = $('#name').val(),
        gender = $('#gender').val(),
        birth = $('#birthdate').val(),

        // Friend only
        nif = $('#nif').val(),
        cellphone = $('#cellphone').val(),
        donativeType = $('#paymethod').val(),
        periodicity = $('#periodicity').val();
    if (role !== 'Amigo') {
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
            function (data, statusText, xhr) {
                $('#userModal').modal('hide');

                var tr = $('#users tr:last'),
                    trNew = tr.clone();
                trNew.attr("id", "user" + id);
                trNew.removeClass("warning");
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
        .fail(function (error) {
            $('#userStatus').fadeIn();
        });
}

/**
 * Update user in the database
 */
function updateUser() {
    // Variables
    var id = $('#identification').val(),
        role = $('#role').val(),
        email = $('#email').val(),
        password = $('#password').val(),
        name = $('#name').val(),
        gender = $('#gender').val(),
        birth = $('#birthdate').val(),

        // Friend only
        nif = $('#nif').val(),
        cellphone = $('#cellphone').val(),
        donativeType = $('#paymethod').val(),
        periodicity = $('#periodicity').val();

    if (role !== 'Amigo') {
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
            function (data, statusText, xhr) {
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
        .fail(function (error) {
            $('#userStatus').fadeIn();
        });
}

/**
 * Configuration of the new user modal
 */
function configNewUserModal() {
    $('#userModal form').trigger('reset');

    $('#friendOnlyParams').fadeIn();
    $('label[for="password"]').show();
    $('#password').attr("required", "required");
    $('#password').show();
    $('#identification').removeAttr('disabled');

    $('#userModalTitle').html('Novo Utilizador');
}

/**
 * Configure the elements
 */
function config() {
    $('#newUser').click(configNewUserModal);

    $('#userForm').submit(function (e) {
        e.preventDefault();
        if ($('#userModalTitle').text() == 'Novo Utilizador')
            registerUser();
        else
            updateUser();
    });

    $('#userStatus').click(function () {
        $(this).fadeOut();
    });

    $('#role').change(function () {
        var role = $('#role').val();
        if (role === 'Amigo') {
            $('#nif').attr("required", "required");
            $('#cellphone').attr("required", "required");
            $('#paymethod').attr("required", "required");
            $('#periodicity').attr("required", "required");
            $('#friendOnlyParams').fadeIn();
        } else {
            $('#nif').removeAttr("required");
            $('#cellphone').removeAttr("required");
            $('#paymethod').removeAttr("required");
            $('#periodicity').removeAttr("required");
            $('#friendOnlyParams').fadeOut();
        }
    });
}

/**
 * On document ready
 */
$(document).ready(config);
