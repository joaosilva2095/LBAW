/*global $ */

/**
 * Mark a notification as seen
 */
function markNotification() {
    var id = $(this).attr('id');
    id = id.replace("notification", "");

    // Async call to mark notification
    $.post(
            "../api/mark_notification.php", {
                id: id
            },
            function (data, statusText, xhr) {
                $('#notification' + id).remove();
                var badges = $('#notifications .badge');
                badges.html(parseInt(badges.html()) - 1);
            })
        .fail(function (error) {
            $('#notification' + id).highlightAnimation(red, 1500);
        });
}

/**
 * Configure the elements
 */
function config() {
    // Dropdown toggler
    $('#notifications a').click(function (event) {
        $(this).parent().toggleClass('open');
    });

    $('body').click(function (e) {
        if (!$('#notifications').is(e.target) && $('#notifications').has(e.target).length === 0 && $('.open').has(e.target).length === 0) {
            $('#notifications').removeClass('open');
        }
    });

    $('#notifications li').click(markNotification);
}

/**
 * On document ready
 */
$(document).ready(config);
