<div class="modal fade" tabindex="-1" role="dialog" id="editDonativeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="editDonativeModalTitle" class="modal-title">Editar Donativo</h4>
            </div>
            <div class="modal-body">
                <form id="editDonativeForm" onsubmit="editDonativeHistory(); return false;">           

                    <div class="form-group">
                        <label for="editDonativeDate">Data de pagamento:</label>
                        <input type="date" class="form-control" id="editDonativeDate">
                    </div>
                    
                    <div class="form-group">
                        <label for="editDonativeValue">Valor (EUR):</label>
                        <input type="number" class="form-control" id="editDonativeValue">
                    </div>

                    <div class="form-group">
                        <label for="editDonativeReceipt">Fatura (URL):</label>
                        <input class="form-control" id="editDonativeReceipt">
                    </div>
                    
                    <div class="form-group">
                        <label for="editDonativeReference">Referência (ATM):</label>
                        <input type="number" class="form-control" id="editDonativeReference">
                    </div>
                    
                    <div class="form-group">
                        <label for="editDonativePayMethod">Método de Pagamento:</label>
                        <input type="number" class="form-control" id="editDonativePayMethod">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <input id="editDonativeSubmit" type="submit" class="btn btn-primary" form="editDonativeForm"></input>
            </div>
        </div>
    </div>
</div>