$(document).ready(function () {

    $('[data-toggle="tooltip"]').tooltip({
        placement: 'top'
    });

    $('#EditUserModal').click(function () {
        var name = $("#UserName").text();
        var email = $("#UserEmail").text();
        var cellphone = $("#UserCellphone").text();
        var birth = $("#UserBirth").text();

        //set form
        $('#name').val(name);
        $('#dateBirth').val(birth);
        $('#email').val(email);
        $('#contact').val(cellphone);
    });

    // $('#EditProfileSubmit').click(editUser);   ja nao é necessari, fio criado metodo onsubmit
    //  $('#EditPaymentSubmit').click();

});

function editUser(id) {

    var name = $('#name').val(),
        email = $('#email').val(),
        birth = $('#dateBirth').val(),
        cellphone = $('#contact').val();
    
    alert(name + email + birth + cellphone);
    
    $.post(
        "../api/edit_profile.php", {
            id: id,
            email: email,
            name: name,
            birth: birth,
            cellphone: cellphone
        },
        function (data, statusText, xhr) {                                  
            $('#editProfile').modal('hide');

            $("#UserName").html(name);
            $("#UserEmail").html(email);
            $("#UserBirth").html(birth);
            $("#UserCellphone").html(cellphone);
        })
        .fail(function (error) {
            $('#userStatus').fadeIn();
        });


}
function editUserPaymentMethod() {

    $.post(
        "../api/editPaymentMethodUser.php", {
            /*
            
            var name = $("#user" + id + " td:nth-child(2)").text();
              var email = $("#user" + id + " td:nth-child(3)").text();
              var gender = $("#user" + id + " td:nth-child(4)").text();
              var birth = $("#user" + id + " td:nth-child(5)").text();
              var cellphone = $("#user" + id + " td:nth-child(6)").text();
            
            
            $.post('http://path/to/post', 
               $('#myForm').serialize(), 
               function(data, status, xhr){
                 // do something here with response;
               });
            */
        });
}
