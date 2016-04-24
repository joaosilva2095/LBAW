/**
 * Function to register a user on submit the form
 */
function registerUser() {
    // Variables
    var name = $('#name').val();
    var email = $('#email').val();
    var birth = $('#birthdate').val();
    var cellphone = $('#cellphone').val();
    var role = $('#role').val();
    var donativeType = ('#paymethod').val();
    var periodicity = ('#periodicity').val();
    var donativeValue = ('#donation').val();

    // Async call to login
    $.post(
        "", // TODO fix URL
        {
            name: name,
            email: email,
            birth: birth,
            cellphone: cellphone,
            role: role,
            donative_type: donativeType,
            periodicity: periodicity,
            donative_value: donativeValue
        },
        function (data) {
            // TODO check error code
        })
        .fail(function (error) {
            displayError("Error while processing the registration of the new user...");
        });
}

/**
 * On document ready
 */
$(document).ready(function () {
    $('#registerUserSubmit').click(registerUser);
});