$(document).ready(function () {

    $('#EditUserModal').click(function () {
        var name = $("#UserName").text();
        var cellphone = $("#UserCellphone").text();
        var birth = $("#UserBirth").text();

        //set form
        $('#name').val(name);
        $('#dateBirth').val(birth);
        $('#contact').val(cellphone);
    });

    $('#EditPaymentModal').click(function (event) {
        event.preventDefault();

        var payment = $("#UserDonative").text();

        $('#sel1').val(payment);
    });


    //Tab1
    $('#TabIrEvento i[data-original-title="Detalhes"]').click(function (event) {
        $('#seeEventModal form').trigger('reset');

        var closest_tr = $(this).closest('tr');
        var tr_id_attr = $(closest_tr).attr('id');
        var id = tr_id_attr.substring(tr_id_attr.indexOf("-") + 1, tr_id_attr.length);

        var description = $("#Evento-" + id + " td:nth-child(2)").text(),
            name = $("#Evento-" + id + " td:nth-child(6)").text();

        // Set form
        $('#seeEventName').val(name);
        $('#seeEventDescription').val(description);
    });

    $('#TabIrEvento i[data-original-title="Eliminar"]').click(confirmRemoveHistory);


    //Tab2
    $('#TabPagEvento i[data-original-title="Editar"]').click(function (event) {
        $('#editEventPaymentModal form').trigger('reset');

        var closest_tr = $(this).closest('tr');
        var tr_id_attr = $(closest_tr).attr('id');
        var id = tr_id_attr.substring(tr_id_attr.indexOf("-") + 1, tr_id_attr.length);

        $('<input>').attr({
            type: 'hidden',
            id: "PayId",
            value: id
        }).appendTo('#editEventPaymentModal form');

        var date = $("#eventoPayment-" + id + " td:nth-child(3)").text(),
            price = $("#eventoPayment-" + id + " td:nth-child(5)").text(),
            url = $("#eventoPayment-" + id + " td:nth-child(2)").text(),
            reference = $("#eventoPayment-" + id + " td:nth-child(6)").text();

        // Set form
        $('#editEventPaymentDate').val(date);
        $('#editEventPaymentValue').val(price);
        $('#editEventPaymentReceipt').val(url);
        $('#editEventPaymentReference').val(reference);
    });

    $('#TabPagEvento i[data-original-title="Eliminar"]').click(confirmRemoveHistory);
    // $('#TabPagEvento i[data-original-title="Obter Fatura"]').click(imprimir);


    //tab3
    $('#TabDonative i[data-original-title="Editar"]').click(function (e) {
        $('#editDonativeModal form').trigger('reset');

        var closest_tr = $(this).closest('tr');
        var tr_id_attr = $(closest_tr).attr('id');
        var id = tr_id_attr.substring(tr_id_attr.indexOf("-") + 1, tr_id_attr.length);

        $('<input>').attr({
            type: 'hidden',
            id: "DonId",
            value: id
        }).appendTo('#editDonativeModal form');

        var date = $("#donative-" + id + " td:nth-child(4)").text(),
            value = $("#donative-" + id + " td:nth-child(5)").text(),
            url = $("#donative-" + id + " td:nth-child(2)").text(),
            reference = $("#donative-" + id + " td:nth-child(6)").text(),
            pay_method = $("#donative-" + id + " td:nth-child(7)").text();

        // Set form
        $('#editDonativeDate').val(date);
        $('#editDonativeValue').val(value);
        $('#editDonativeReceipt').val(url);
        $('#editDonativeReference').val(reference);
        $('#DonativeFormSel1').val(pay_method);
    });

    $('#TabDonative i[data-original-title="Eliminar"]').click(confirmRemoveHistory);
    // $('#TabDonative i[data-original-title="Obter Fatura"]').click(imprimir);

    //Tab4
    $('#TabMercha i[data-original-title="Eliminar"]').click(confirmRemoveHistory);
    // $('#TabMercha i[data-original-title="Obter Fatura"]').click(imprimir);

});

function editUser(id) {

    var name = $('#name').val(),
        birth = $('#dateBirth').val(),
        cellphone = $('#contact').val();
    
    var contentNameNav =  $("#UserNameNav").text();
    var roleContentNav = contentNameNav.substring(contentNameNav.indexOf('('),contentNameNav.length);

    $.post(
        "../api/edit_profile.php", {
            id: id,
            name: name,
            birth: birth,
            cellphone: cellphone
        },
        function (data, statusText, xhr) {           
            console.log(data);
            $('#editProfile').modal('hide');

            $("#UserName").html(name);
            $("#UserBirth").html(birth);
            $("#UserCellphone").html(cellphone);
            $("#UserNameNav").html(name + " " +roleContentNav);
            $('#friend_Status1').fadeIn(1000);
             setTimeout(function () {
                $('#editCredentialsModal').modal('hide');
            }, 1500);
            
        })
        .fail(function (error) {
                       
            console.log(error);
            $('#friend_Status2').fadeIn();
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
            $("#" + type + "-" + id).remove();
        })
        .fail(function (error) {
            $("#" + type + "-" + id).highlightAnimation(red, 1500);
        });
}

function confirmRemoveHistory() {
    var closest_tr = $(this).closest('tr');

    var tr_id_attr = $(closest_tr).attr('id');
    var type = tr_id_attr.substring(0, tr_id_attr.indexOf("-"));
    var id = tr_id_attr.substring(tr_id_attr.indexOf("-") + 1, tr_id_attr.length);

    $('#confirm').modal({
        backdrop: 'static',
        keyboard: false
    })
        .one('click', '#delete', function () {
            removeHistoryEntry(id, type);
        });
}


function editEventPagHistory() {
    var id = $('#PayId').val();

    //vars do form
    var date = $('#editEventPaymentDate').val(),
        price = $('#editEventPaymentValue').val(),
        receipt = $('#editEventPaymentReceipt').val(),
        reference = $('#editEventPaymentReference').val();

    console.log(date, price, receipt, reference);

    $.post(
        "../api/edit_hist_pay_event.php", {
            id: id,
            date: date,
            price: price,
            receipt: receipt,
            reference: reference
        },
        function (data, statusText, xhr) {
            $('#editEventPaymentModal').modal('hide');

            $("#eventoPayment-" + id + " td:nth-child(3)").html(date);
            $("#eventoPayment-" + id + " td:nth-child(5)").html(price);
            $("#eventoPayment-" + id + " td:nth-child(2)").html(receipt);
            $("#eventoPayment-" + id + " td:nth-child(6)").html(reference);
            $("#eventoPayment-" + id).highlightAnimation(green, 2000);
        })
        .fail(function (error) {
            $("#eventoPayment-" + id).highlightAnimation(red, 1500);
        });

}

function editDonativeHistory() {
    var id = $('#DonId').val();

    //vars do form
    var date = $('#editDonativeDate').val(),
        price = $('#editDonativeValue').val(),
        receipt = $('#editDonativeReceipt').val(),
        reference = $('#editDonativeReference').val(),
        pay_method = $('#DonativeFormSel1').val();

   // console.log(id,date, price, receipt, reference, pay_method, id);

    $.post(
        "../api/edit_hist_donative.php", {
            id: id,
            date: date,
            price: price,
            receipt: receipt,
            reference: reference,
            pay_method: pay_method
        },
        function (data, statusText, xhr) {
            //console.log(data);
            $('#editDonativeModal').modal('hide');

            $("#donative-" + id + " td:nth-child(2)").html(receipt);
            $("#donative-" + id + " td:nth-child(4)").html(date);
            $("#donative-" + id + " td:nth-child(5)").html(price);
            $("#donative-" + id + " td:nth-child(6)").html(reference);
            $("#donative-" + id + " td:nth-child(7)").html(pay_method);
            $("#donative-" + id).highlightAnimation(green, 1500);
        })
        .fail(function (error) {
            console.log(error);
            $("#donative-" + id).highlightAnimation(red, 1500);
        });

}
