/**
 * Created by diogo on 04/06/2016.
 */

function buyProductwithReceipt() {
    var form = $('#buyProductForm')[0];
    var fd = new FormData();

    var productId = $('#buyProductId').val();
    var userId = $('#buyerUserId').val();
    var datepayment = $('#paymentDateId').val();
    var quantity = $('#quantity').val();

    fd.append('productId', productId);
    fd.append('datePayment', datepayment);
    fd.append('quantity', quantity);
    fd.append('idUser', userId);
    fd.append('file', $('input[type=file]')[0].files[0]);

    $.ajax({
        url: "../api/buyProduct.php",
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(data) {
            $('#buyProductStatus1').fadeIn(2000);
            setTimeout(function() {
                $('#buyProductModal').modal('hide');
            }, 2000);
            $('#buyProductStatus1').fadeOut();
        }
    }).fail(function(error) {
        $('#buyProductStatus2').fadeIn();
        console.log(error)
    });
}


function configBuyProduct() {
    $('#buyProductModal form').trigger('reset');

    $('#buyProductModal').modal("toggle");
    var productId = $(this).closest('tr').attr('id');
    productId = productId.replace("mercha", "");

    $('#buyProductId').val(productId);
}


/**
 * Configure the elements
 */
function config() {
    // Manage users
    $('i[data-original-title="Adicionar Compra"]').click(configBuyProduct);

    $('#buyProductForm').submit(function(e) {
        e.preventDefault();
        buyProductwithReceipt();
    });
}

/**
 * On document ready
 */
$(document).ready(config);
