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

    // Async call to register           //todo fazer api
    $.post(
        "../api/add_mercha.php", {
            id: id,
            category: category,
            description: description,
            price: price,

        },
        function (data, statusText, xhr) {
            $('#addEventModal').modal('hide');

            var tr = $('#events tr:last'),
                trNew = tr.clone(),
                id = parseInt(data);
            trNew.attr("id", "event" + id);
            tr.after(trNew);

            $("#event" + id + " td:nth-child(1)").html(description);
            $("#event" + id + " td:nth-child(2)").html(name);
            $("#event" + id + " td:nth-child(3)").html(date);
            $("#event" + id + " td:nth-child(4)").html(duration);
            $("#event" + id + " td:nth-child(5)").html(place);
            $("#event" + id + " td:nth-child(6)").html(price);

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
function updateMercha() {           //todo fazer api
    // Variables
    // Fill data
    var id = $('#id').val(),
        name = $('#name').val(),
        description = $('#description').val(),
        date = $('#date').val(),
        duration = $('#duration').val(),
        place = $('#place').val(),
        price = $('#price').val();

    // Async call to edit
    $.post(
        "../api/edit_event.php", {
            id: id,
            name: name,
            description: description,
            date: date,
            duration: duration,
            place: place,
            price: price
        },
        function (data, statusText, xhr) {
            $('#addEventModal').modal('hide');

            $("#event" + id + " td:nth-child(1)").html(description);
            $("#event" + id + " td:nth-child(2)").html(name);
            $("#event" + id + " td:nth-child(3)").html(date);
            $("#event" + id + " td:nth-child(4)").html(duration);
            $("#event" + id + " td:nth-child(5)").html(place);
            $("#event" + id + " td:nth-child(6)").html(price);

            $('#event' + id).highlightAnimation(green, 1500);
        })
        .fail(function (error) {
            $('#addEventStatus').fadeIn();
        });
}

/**
 * Configuration of the new event modal
 */
function configNewEventModal() {
    $('#addEventModal form').trigger('reset');

    $('#addEventModalTitle').html('Novo Evento');
}

/**
 * Configure the elements
 */
function config() {
    $('#newEvent').click(configNewEventModal);

    $('#addEventForm').submit(function (e) {
        e.preventDefault();
        if ($('#addEventModalTitle').text() === 'Novo Evento')
            registerEvent();
        else
            updateEvent();
    });

    $('#addEventStatus').click(function () {
        $(this).fadeOut();
    });
}

/**
 * On document ready
 */
$(document).ready(config);
