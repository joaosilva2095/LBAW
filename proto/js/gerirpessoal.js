/**
 * Function to register a user on submit the form
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


    console.log(role);

    // Async call to login
    $.post(
        "../api/register_user.php",
        {
            id: id,
            role: role,
            email: email,
            password: password,
            name: name,
            gender: gender,
            birth: birth
        },
        function (data, statusText, xhr) {
            $('#registerUser').modal('hide');
        })
        .fail(function (error) {
            console.log("Error while processing the registration of the new user...");
            console.log(error.status);
        });
}

/**
 * Function to register a friend
 */
function registerFriend() {
    // Variables
    var id = $('#identification').val();
    var role = $('#role').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var name = $('#name').val();
    var gender = $('#gender').val();
    var birth = $('#birthdate').val();

    var nif = $('#nif').val();
    var cellphone = $('#cellphone').val();
    var donativeType = $('#paymethod').val();
    var periodicity = $('#periodicity').val();

    // Async call to login
    $.post(
        "../api/register_user.php",
        {
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
            $('#registerUser').modal('hide');
        })
        .fail(function (error) {
            console.log("Error while processing the registration of the new user...");
            console.log(error.status);
        });
}

/**
 * On document ready
 */
$(document).ready(function () {
    $('#registerUserSubmit').click(function () {
        var role = $('#role').val();
        if (role === 'Amigo') registerFriend();
        else registerUser();
    });

    $('#role').change(function () {
        var role = $('#role').val();
        if (role === 'Amigo') {
            $('#friendOnlyParams').fadeIn();
        } else {
            $('#friendOnlyParams').fadeOut();
        }
    });
});