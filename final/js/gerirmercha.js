/**
 * Remove a mercha product from the database
 * @param {integer} id id of the mercha product to be removed
 */
function removeMercha(id) {
    // Async call to remove mercha
    $.post(
            "../api/delete_mercha.php", {
                id: id
            },
            function (data, statusText, xhr) {
                $('#mercha' + id).remove();
            })
        .fail(function (error) {
            $('#mercha' + id).highlightAnimation(red, 1500);
        });
}

/**
 * Confirm remove Mercha
 */
function confirmRemoveMercha() {
    // Variables
    var id = $(this).closest('tr').attr('id');
    id = id.replace("mercha", "");

    $('#confirm').modal({
            backdrop: 'static',
            keyboard: false
        })
        .one('click', '#delete', function () {
            removeMercha(id);
        });
}

/**
 * Configuration of the edit Mercha modal
 */
function configEditMerchaModal() {
    $('#addMerchaModal form').trigger('reset');
    $('#addMerchaModalTitle').html('Editar Mercha');

    // Fill data
    var id = $(this).closest('tr').attr('id');
    id = id.replace("mercha", "");

    var id = $("#mercha" + id + " td:nth-child(1)").text(),
        category = $("#mercha" + id + " td:nth-child(2)").text(),
        description = $("#mercha" + id + " td:nth-child(3)").text(),
        price = $("#mercha" + id + " td:nth-child(4)").text();

    // Set form
    $('#id').val(id);
    $('#category').val(category);
    $('#description').val(description);
    $('#price').val(price);
}


/**
 * Configure the elements
 */
function config() {
    // Manage users
    $('i[data-original-title="Editar"]').click(configEditMerchaModal);
    $('i[data-original-title="Eliminar"]').click(confirmRemoveMercha);
}

/**
 * On document ready
 */
$(document).ready(config);

