/*global $ */

/**
 * Function to register a event
 */
function registerEvent() {
    // Variables
    var name = $('#name').val(),
        description = $('#description').val(),
        date = $('#date').val(),
        duration = $('#duration').val(),
        place = $('#place').val(),
        price = $('#price').val();

    // Async call to register
    $.post(
            "../api/register_event.php", {
                name: name,
                description: description,
                date: date,
                duration: duration,
                place: place,
                price: price
            },
            function (data, statusText, xhr) {
                $('#addEventModal').modal('hide');

                var tr = $('#events tr:last'),
                    trNew = tr.clone();
                trNew.attr("id", "event" + id);
                tr.after(trNew);

                $("#event" + id + " td:nth-child(1)").html(id);
                $("#event" + id + " td:nth-child(2)").html(description);
                $("#event" + id + " td:nth-child(3)").html(name);
                $("#event" + id + " td:nth-child(4)").html(date);
                $("#event" + id + " td:nth-child(5)").html(duration);
                $("#event" + id + " td:nth-child(6)").html(place);
                $("#event" + id + " td:nth-child(7)").html(price);

                trNew.highlightAnimation(green, 1500);

                // Update listeners
                $('i[data-original-title="Eliminar"]').click(removeEvent);
                enableTooltips();
            })
        .fail(function (error) {
            $('#addEventStatus').fadeIn();
        });
}

/**
 * Update event in the database
 */
function updateEvent() {
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
                $('#addUserModal').modal('hide');

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
            $('#addUserStatus').fadeIn();
        });
}

/**
 * Configuration of the new user modal
 */
function configNewUserModal() {
    $('#addUserModal form').trigger('reset');

    $('#friendOnlyParams').fadeIn();
    $('label[for="password"]').show();
    $('#password').attr("required", "required");
    $('#password').show();
    $('#identification').removeAttr('disabled');

    $('#addUserModalTitle').html('Novo Utilizador');
}

/**
 * Configure the elements
 */
function config() {
    $('#newUser').click(configNewUserModal);

    $('#addUserForm').submit(function (e) {
        e.preventDefault();
        if ($('#addUserModalTitle').text() === 'Novo Utilizador')
            registerUser();
        else
            updateUser();
    });

    $('#addUserStatus').click(function () {
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
