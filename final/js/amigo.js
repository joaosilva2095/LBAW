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

    $('#EditPaymentModal').click(function (event) {
        event.preventDefault();

        var payment = $("#UserDonative").text();

        $('#sel1').val(payment);
    });
    
    $('#RemoveEntry').click(removeHistoryEntry);
    

});

function editUser(id) {

    var name = $('#name').val(),
        email = $('#email').val(),
        birth = $('#dateBirth').val(),
        cellphone = $('#contact').val();

    //alert(name + email + birth + cellphone);

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
            $("#UserNameNav").html(name + " (Amigo)");
        })
        .fail(function (error) {
            console.log(error);
            $('#friendStatus').fadeIn();
        });


}

function editUserPayment(id) {
    var payment = $('#sel1').val();

    $.post(
        "../api/edit_donative_meth.php", {
            id: id,
            payment: payment
        },
        function (data, statusText, xhr) {
            $('#methPayment').modal('hide');
            $("#UserDonative").html(payment);
        })
        .fail(function (error) {
            console.log(error);
            $('#friendStatus2').fadeIn();
        });
}


function removeHistoryEntry(){
        
    var id = $($(this).closest('tr').children()[0]).html();
    var type = $($(this).closest('tr').children()[2]).html();
   
    $.post(
        "../api/remove_hist_entry.php", {
            id: id,
            type: type
        },
        function (data, statusText, xhr) {
          //  $('#methPayment').modal('hide');
          //  $("#UserDonative").html(payment);
        })
        .fail(function (error) {
            console.log(error);
            $('#friendStatus2').fadeIn();
        });    
}
