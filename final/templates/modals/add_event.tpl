<div class="modal fade" tabindex="-1" role="dialog" id="addEventModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="addEventModalTitle" class="modal-title">Adicionar Evento</h4>
            </div>
            <div class="modal-body">
                <form id="addEventForm">
                    <input style="display:none;" class="form-control" id="id">
                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input class="form-control" id="name" required="required">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição:</label>
                        <textarea rows="10" style="resize:none;" class="form-control" id="description" required="required"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="date">Data:</label>
                        <input type="date" class="form-control" id="date" required="required">
                    </div>
                    <div class="form-group">
                        <label for="duration">Duração (horas):</label>
                        <input type="number" class="form-control" id="duration" required="required">
                    </div>
                    <div class="form-group">
                        <label for="place">Local:</label>
                        <input class="form-control" id="place" required="required">
                    </div>
                    <div class="form-group">
                        <label for="price">Preço (€):</label>
                        <input type="number" step="any" class="form-control" id="price" required="required">
                    </div>
                </form>
                <div class="alert alert-danger alert-dismissible" style="display: none;" role="alert" id="addEventStatus">
                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    Failed to complete the event action! Please verify the information.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" form="addEventForm" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script src="{$BASE_URL}js/modals/add_event.min.js"></script>
