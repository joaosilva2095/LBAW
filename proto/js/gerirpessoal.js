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
                $('#registerUser').modal('hide');
                $('#registerUser form').trigger('reset');

                $('#users tr:last').after(
                    '<tr>' +
                    '<td>' + id + '</td>' +
                    '<td>' + name + '</td>' +
                    '<td>' + birth + '</td>' +
                    '<td>' + role + '</td>' +
                    '<td>' +
                    '<i class="fa fa-pencil fa-lg fa-fw" data-toggle="tooltip" data-original-title="Editar"></i>' +
                    '<i class="fa fa-briefcase fa-lg fa-fw" data-toggle="tooltip" data-original-title="Alterar Cargo"></i>' +
                    '<i class="fa fa-trash fa-lg fa-fw" data-toggle="tooltip" data-original-title="Eliminar"></i>' +
                    '</td>' +
                    '</tr>'
                );
                $('#users tr:last').highlightAnimation('#DFF0D8', 1500);
            })
        .fail(function(error) {
            console.log("Error while processing the registration of the new user...");
            console.log(error.status);
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
    $('#registerUserSubmit').click(registerUser);

    $('#role').change(function() {
        var role = $('#role').val();
        if (role === 'Amigo') {
            $('#friendOnlyParams').fadeIn();
        } else {
            $('#friendOnlyParams').fadeOut();
        }
    });
});