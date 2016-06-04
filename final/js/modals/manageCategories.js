/**
 * Created by diogo on 04/06/2016.
 */
/**
 * Created by diogo on 04/06/2016.
 */
/*global $ */

/**
 * Function to register a mercha product
 */
function newCat() {
    // Variables
    var category = $('#newCatName').val();

    // Async call to register
    $.post(
        "../api/manageCategories.php", {
            category: category,
            type:'CREATE'
        },
        function (data, statusText, xhr) {
                var form = $('#newCatForm');
                form.highlightAnimation(green, 1500);

                $('#newCatModal').modal('hide');

        })
        .fail(function (error) {
            $('#newCatStatus').fadeIn();
        });
}

/**
 * Delete Categories in the database
 */
function delCat() {
    // Variables
    // Fill data
    var description = $('#delCatName').val();

    // Async call to edit
    $.post(
        "../api/manageCategories.php", {
            category: category
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
            $('#delCatStatus').fadeIn();
        });
}

/**
 * Configure the elements
 */
function config() {
    $('#newCatForm').submit(function (e) {
        e.preventDefault();
        newCat();
    });

    $('#delCatForm').submit(function (e) {
        e.preventDefault();
        delCat();
    });

}

/**
 * On document ready
 */
$(document).ready(config);
