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
            type: 'CREATE'
        },
        function (data, statusText, xhr) {
            var form = $('#newCatForm');
            $('#newCatModal').highlightAnimation(green, 1500);

            $('#category').append($('<option>', {
                value: category,
                text: category
            }));

            $('#delCatName').append($('<option>', {
                value: category,
                text: category
            }));

            $('#newCatStatus1').fadeIn(2000);
            setTimeout(function () {
                $('#newCatModal').modal('hide');
            }, 2000);
            $('#newCatStatus1').fadeOut();
        })
        .fail(function (error) {
            $('#newCatStatus2').fadeIn();
        });
}

/**
 * Delete Categories in the database
 */
function delCat() {
    // Variables
    // Fill data
    var category = $('#delCatName').val();

    // Async call to register
    $.post(
        "../api/manageCategories.php", {
            category: category,
            type: 'DELETE'
        },
        function (data, statusText, xhr) {
            $("#category option[value=" + category + "]").remove();
            $("#delCatName option[value=" + category + "]").remove();

            $('#delCatStatus1').fadeIn(2000);
            setTimeout(function () {
                $('#delCatModal').modal('hide');
            }, 2000);
            $('#delCatStatus1').fadeOut();

        })
        .fail(function (error) {
            $('#delCatStatus2').fadeIn();
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
