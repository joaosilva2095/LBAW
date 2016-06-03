<!-- Add notification modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="notificationModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Adicionar Notificação</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="notificationForm">
                    <input style="display: none;" class="form-control" id="notificationUserId" disabled="disabled">
                    <div class="form-group">
                        <label for="notificationMessage">Mensagem:</label>
                        <input class="form-control" id="notificationMessage" required="required">
                    </div>
                    <div class="form-group">
                        <label for="notificationType">Tipo:</label>
                        <select class="form-control" id="notificationType" required="required">
                            <option value="Success">Sucesso</option>
                            <option value="Info">Informação</option>
                            <option value="Warning">Aviso</option>
                            <option value="Danger">Importante</option>
                        </select>
                    </div>
                </form>
                <div class="alert alert-danger alert-dismissible" style="display: none;" role="alert" id="notificationStatus">
                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true ">&times;</span>
                    </button>
                    Failed to add the notification!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" form="notificationForm" class="btn btn-primary">Adicionar</button>
            </div>
        </div>
    </div>
</div>
