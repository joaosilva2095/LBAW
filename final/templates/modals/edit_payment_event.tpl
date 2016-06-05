<div class="modal fade" tabindex="-1" role="dialog" id="editEventPaymentModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="editEventPaymentModalTitle" class="modal-title">Editar Pagamento do Evento</h4>
            </div>
            <div class="modal-body">
                <form id="editEventPaymentForm" onsubmit="editEventPagHistory(); return false;">

                    <div class="form-group">
                        <label for="editEventPaymentDate">Data de pagamento:</label>
                        <input type="text" class="date-picker form-control" id="editEventPaymentDate">
                    </div>

                    <div class="form-group">
                        <label for="editEventPaymentValue">Preço (EUR):</label>
                        <input type="number" step="0.01" min="0" class="form-control" id="editEventPaymentValue">
                    </div>

                    <div class="form-group">
                        <label for="editEventPaymentReceipt">Fatura (URL):</label>
                        <input class="form-control" id="editEventPaymentReceipt">
                    </div>

                    <div class="form-group">
                        <label for="editEventPaymentReference">Referência Multibanco:</label>
                        <input type="number" min="0" class="form-control" id="editEventPaymentReference">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <input id="editEventPaymentSubmit" type="submit" class="btn btn-primary" form="editEventPaymentForm">
            </div>
        </div>
    </div>
</div>
