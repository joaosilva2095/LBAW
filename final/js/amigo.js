$(document).ready(function () {

    $('#EditProfileSubmit').click();
    $('#EditPaymentSubmit').click();

});


function editUser() {

    var name = $("#EditProfileSubmit" + id + " td:nth-child(2)").text();
    var email = $("#EditProfileSubmit" + id + " td:nth-child(3)").text();
    var gender = $("#EditProfileSubmit" + id + " td:nth-child(4)").text();
    var birth = $("#EditProfileSubmit" + id + " td:nth-child(5)").text();
    var cellphone = $("#EditProfileSubmit" + id + " td:nth-child(6)").text();

    $.post(
        "../api/edit_profile.php", {
                
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
