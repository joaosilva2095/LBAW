<div class="modal fade" tabindex="-1" role="dialog" id="buyProductModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="buyProductModalTitle" class="modal-title">Adicionar Compra</h4>
            </div>
            <div class="modal-body">
                <form id="buyProductForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="buyerUserId">ID Utilizador:</label>
                        <input class="form-control" id="buyerUserId" required="required">
                    </div>
                    <h4>Informação de Pagamento</h4>
                    <div class="form-group">
                        <label for="paymentDateId">Data do Pagamento:</label>
                        <input type="date" class="form-control" id="paymentDateId" placeholder="Data do Pagamento">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantidade:</label>
                        <input type="number" step="1" class="form-control" id="quantity">
                    </div>
                    <div class="form-group">
                        <label for="receipt">Recibo:</label>
                        <input type="file"class="form-control" id="receipt">
                    </div>
                </form>
                <div class="alert alert-danger alert-dismissible" style="display: none;" role="alert" id="buyProductStatus">
                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    Failed to complete the friend attendance in event action! Please verify the information.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" form="buyProductForm" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script src="{$BASE_URL}js/modals/buyProduct.js"></script>
