$(document).ready(function () {

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

    $('i[data-original-title="Editar"]').click(editHistoryEntry);
    $('i[data-original-title="Eliminar"]').click(confirmRemoveHistoryEntry);
    

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


function removeHistoryEntry(id, type) {
 
    $.post(
        "../api/remove_hist_entry.php", {
            id: id,
            type: type
        },
        function (data, statusText, xhr) {
            $("#" + type + id).remove();
        })
        .fail(function (error) {
            $("#" + type + id).highlightAnimation(red, 1500);
        });
}

function confirmRemoveHistoryEntry() {
    var closest_tr = $(this).closest('tr'),
        id = $(closest_tr.children()[0]).html(),
        type = $(closest_tr.children()[2]).html();
      
    $('#confirm').modal({
        backdrop: 'static',
        keyboard: false
    })
        .one('click', '#delete', function () {
            removeHistoryEntry(id, type);
        });
}


function editHistoryEntry(){
     var closest_tr = $(this).closest('tr'),
        id = $(closest_tr.children()[0]).html(),
        type = $(closest_tr.children()[2]).html();
        
        alert(closest_tr);
        
       /*
        $.post(
        "../api/edit_hist_entry.php", {
            id: id,
            type: type
        },
        function (data, statusText, xhr) {
            $('#editHistory').modal('hide');
            
            $("#UserName").html(name);
            $("#UserEmail").html(email);
            $("#UserBirth").html(birth);
            $("#UserCellphone").html(cellphone);
            $("#UserNameNav").html(name + " (Amigo)");
        })
        .fail(function (error) {
            $("#" + type + id).highlightAnimation(red, 1500);
        }); 
    */    
}