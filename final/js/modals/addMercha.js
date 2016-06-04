/**
 * Created by diogo on 04/06/2016.
 */
/*global $ */

/**
 * Function to register a event
 */
function registerMercha() {
    // Variables
    var id = $('#id').val(),
        category = $('#category').val(),
        description = $('#description').val(),
        price = $('#price').val();

    // Async call to register
    $.post(
        "../api/add_mercha.php", {
            id: id,
            category: category,
            description: description,
            price: price,

        },
        function (data, statusText, xhr) {
            $('#addMerchaModal').modal('hide');

            var tr = $('#mercha tr:last'),
                trNew = tr.clone(),
                id = parseInt(data);
            trNew.attr("id", "mercha" + id);
            tr.after(trNew);

            $("#event" + id + " td:nth-child(1)").html(id);
            $("#event" + id + " td:nth-child(2)").html(category);
            $("#event" + id + " td:nth-child(3)").html(description);
            $("#event" + id + " td:nth-child(4)").html(price);

            trNew.highlightAnimation(green, 1500);

            // Update listeners
            $('i[data-original-title="Editar"]').click(configEditEventModal);
            $('i[data-original-title="Eliminar"]').click(confirmRemoveEvent);
            enableTooltips();
        })
        .fail(function (error) {
            $('#addEventStatus').fadeIn();
        });
}

/**
 * Update event in the database
 */
function updateMercha() {
    // Variables
    // Fill data
    var id = $('#id').val(),
        description = $('#description').val(),
        category = $('#category').val(),
        price = $('#price').val();

    // Async call to edit
    $.post(
        "../api/edit_mercha.php", {
            id: id,
            category: category,
            description: description,
            price: price
        },
        function (data, statusText, xhr) {
            $('#addMerchaModal').modal('hide');

            $("#mercha" + id + " td:nth-child(1)").html(id);
            $("#mercha" + id + " td:nth-child(2)").html(category);
            $("#mercha" + id + " td:nth-child(3)").html(description);
            $("#mercha" + id + " td:nth-child(4)").html(price);

            $('#mercha' + id).highlightAnimation(green, 1500);
        })
        .fail(function (error) {
            $('#addmerchaStatus').fadeIn();
        });
}

/**
 * Configuration of the new event modal
 */
function configNewMerchaModal() {
    $('#addMerchaModal form').trigger('reset');

    $('#addMerchaModalTitle').html('Novo Mercha');
}

/**
 * Configure the elements
 */
function config() {
    $('#newMercha').click(configNewEventModal);

    $('#addMerchaForm').submit(function (e) {
        e.preventDefault();
        if ($('#addEventModalTitle').text() === 'Novo Mercha')
            registerMercha();
        else
            updateMercha();
    });

    $('#addEventStatus').click(function () {
        $(this).fadeOut();
    });
}

/**
 * On document ready
 */
$(document).ready(config);
