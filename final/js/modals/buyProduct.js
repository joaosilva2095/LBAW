/**
 * Created by diogo on 04/06/2016.
 */

function buyProduct(productId) {

    var userId = $('#buyerUserId').val();
    var datepayment = $('#paymentDateId').val();
    var quantity = $('#quantity').val();


    $.post("../api/buyProduct.php", {
        idUser: userId,
        datePayment: datepayment,
        productId: productId,
        quantity: quantity
    }, function (data, statusText, xhr) {
        console.log(data);
        if (data === "success") {
            $("#buyProductModal").modal("toggle");
        } else {
            $('#buyProductStatus').fadeIn();
        }
    }).fail(function (error) {
        $('#buyProductStatus').fadeIn();
    });


}

function buyProductwithReceipt(productId) {
    var form = $('#buyProductForm')[0];
    var fd = new FormData();

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
        success: function (data) {
            $('#buyProductModal').modal("toggle");
        }
    }).fail(function (error) {
        console.log(error)
    });
}


function configBuyProduct() {
    $('#buyProductModal').trigger('reset');

    $('#buyProductModal').modal("toggle");
    var productId = $(this).closest('tr').attr('id');
    productId = productId.replace("mercha", "");
    $('#buyProductForm').submit(function (e) {
        e.preventDefault();
        buyProductwithReceipt(productId);
    });
}


/**
 * Configure the elements
 */
function config() {
    // Manage users
    $('i[data-original-title="Comprar"]').click(configBuyProduct);
}

/**
 * On document ready
 */
$(document).ready(config);