<div class="modal fade" tabindex="-1" role="dialog" id="addUserAttendanceEventModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="addUserAttendanceEventModalTitle" class="modal-title">Adicionar Presença</h4>
            </div>
            <div class="modal-body">
                <form id="addUserAttendanceEventForm">
                    <input style="display:none;" class="form-control" id="attendanceEventId">
                    <div class="form-group">
                        <label for="attendanceUserId">ID Utilizador:</label>
                        <input class="form-control" id="attendanceUserId" required="required">
                    </div>
                    <div class="form-group">
                        <label for="attendancePaymentId">ID Pagamento:</label>
                        <input type="text" class="form-control" id="attendancePaymentId" placeholder="ID do pagamento associado se existir.">
                    </div>
                </form>
                <div class="alert alert-danger alert-dismissible" style="display: none;" role="alert" id="addUserAttendanceEventStatus">
                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    Failed to complete the friend attendance in event action! Please verify the information.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" form="addUserAttendanceEventForm" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script src="{$BASE_URL}js/modals/add_friend_event.min.js"></script>
