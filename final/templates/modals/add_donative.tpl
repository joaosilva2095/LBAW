<div class="modal fade" tabindex="-1" role="dialog" id="addDonativeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="addDonativeTitle" class="modal-title">Adicionar Donativo</h4>
            </div>
            <div class="modal-body">
                <form id="addDonativeForm">
                    <input style="display:none;" class="form-control" id="addDonativeUserId">
                    <div class="form-group">
                        <label for="addDonativeName">Nome:</label>
                        <input class="form-control" id="addDonativeName" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="addDonativeDate">Data do Donativo:</label>
                        <input type="date" class="form-control" id="addDonativeDate" placeholder="Data do Pagamento" required="required">
                    </div>
                    <div class="form-group">
                        <label for="addDonativeATMReference">Referência Multibanco:</label>
                        <input type="number" step="1" min="0" class="form-control" id="addDonativeATMReference" required="required">
                    </div>
                    <div class="form-group">
                        <label for="addDonativeType">Tipo de Donativo:</label>
                        <input type="text" class="form-control" id="addDonativeType" disabled="disabled" required="required">
                    </div>
                    <div class="form-group">
                        <label for="addDonativeValue">Valor (€):</label>
                        <input type="number" step="0.01" min="0" class="form-control" id="addDonativeValue" required="required">
                    </div>
                    <div class="form-group">
                        <label for="addDonativeReceipt">Recibo:</label>
                        <input type="file" class="form-control" id="addDonativeReceipt" required="required">
                    </div>
                </form>
                <div class="alert alert-danger alert-dismissible" style="display: none;" role="alert" id="addDonativeStatus">
                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    Failed to complete the add user donative action! Please verify the information.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" form="addDonativeForm" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script src="{$BASE_URL}js/modals/add_donative.min.js"></script>
