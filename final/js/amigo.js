$(document).ready(function () {

    $('[data-toggle="tooltip"]').tooltip({
        placement: 'top'
    });

    $('#EditUserModal').click(function(){ 
        console.log("cenas");
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

    //  $('#EditProfileSubmit').click();
    //  $('#EditPaymentSubmit').click();

});


function editUser() {

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
