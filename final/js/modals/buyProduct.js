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
        if(data==="success"){
            $("#buyProductModal").modal("toggle");
        }else{
            $('#buyProductStatus').fadeIn();
        }
    }).fail(function (error) {
        $('#buyProductStatus').fadeIn();
    });


}


function configBuyProduct() {
    $('#buyProductModal').trigger('reset');

    $('#buyProductModal').modal("toggle");
    var productId = $(this).closest('tr').attr('id');
    productId = productId.replace("mercha", "");
    $('#buyProductForm').submit(function (e) {
        e.preventDefault();
        buyProduct(productId);
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