/**
 * Created by diogo on 04/06/2016.
 */
/*global $ */

/**
 * Function to register a mercha product
 */
function registerMercha() {
    // Variables
    var category = $('#category').val(),
        description = $('#description').val(),
        price = $('#price').val();

    // Async call to register
    $.post(
        "../api/add_mercha.php", {
            category: category,
            description: description,
            price: price

        },
        function (data, statusText, xhr) {
            if(data !=="") {
                $('#addMerchaModal').modal('hide');

                var tr = $('#merchas tr:last'),
                    trNew = tr.clone(),
                    id = parseInt(data);
                trNew.attr("id", "mercha" + id);
                tr.after(trNew);

                $("#mercha" + id + " td:nth-child(1)").html(id);
                $("#mercha" + id + " td:nth-child(2)").html(category);
                $("#mercha" + id + " td:nth-child(3)").html(description);
                $("#mercha" + id + " td:nth-child(4)").html(price);

                trNew.highlightAnimation(green, 1500);

                // Update listeners
                $('i[data-original-title="Editar"]').click(configEditMerchaModal);
                $('i[data-original-title="Eliminar"]').click(confirmRemoveMercha);
                enableTooltips();
            }else
                $('#addMerchaStatus').fadeIn();
        })
        .fail(function (error) {
            $('#addMerchaStatus').fadeIn();
        });
}

/**
 * Update Mercha in the database
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
 * Configuration of the new mercha modal
 */
function configNewMerchaModal() {
    $('#addMerchaModal form').trigger('reset');

    $('#addMerchaModalTitle').html('Adicionar Mercha');
}

/**
 * Configure the elements
 */
function config() {
    $('#newMercha').click(configNewMerchaModal);

    $('#addMerchaForm').submit(function (e) {
        e.preventDefault();
        if ($('#addMerchaModalTitle').text() === 'Adicionar Mercha')
            registerMercha();
        else
            updateMercha();
    });

    $('#addMerchaStatus').click(function () {
        $(this).fadeOut();
    });
}

/**
 * On document ready
 */
$(document).ready(config);
