<!-- Modal -->
    <div id="methPayment" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" for="sel1">Método de pagamento</h4>
                </div>
                <div class="modal-body">
                    <form id = "editUserPayment" role="form" onsubmit="editUserPayment({$user.id}); return false;">
                        <select id="sel1" class="form-control">
                            <option value="" disabled="disabled">&nbsp;</option>
                            <option value="Referência Multibanco">Referência Multibanco</option>
                            <option value="Numerário">Numerário</option>
                            <option value="Transferência Bancária">Transferência Bancária</option>
                            <option value="Débito Direto">Débito Direto</option>
                        </select>
                    </form>
                      <div class="alert alert-danger alert-dismissible" style="display: none;" role="alert" id="friendStatus2">
                        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        Failed to complete the action! Please verify the information.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <input id="EditPaymentSubmit" type="submit" class="btn btn-primary" form="editUserPayment"></input>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->