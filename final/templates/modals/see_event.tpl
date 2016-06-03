<div class="modal fade" tabindex="-1" role="dialog" id="seeEventModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="seeEventModalTitle" class="modal-title">Ver Evento</h4>
            </div>
            <div class="modal-body">
                <form id="seeEventForm">
                    <input style="display:none;" class="form-control" id="id">
                    <div class="form-group">
                        <label for="seeEventName">Nome:</label>
                        <input class="form-control" id="seeEventName" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="seeEventDescription">Descrição:</label>
                        <textarea rows="10" style="resize:none;" class="form-control" id="seeEventDescription" disabled="disabled"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
