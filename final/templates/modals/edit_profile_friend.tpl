  <!-- Modal -->
    <div id="editProfile" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar Perfil</h4>
                </div>
                <div class="modal-body">
                    <form id = "editFriendForm" role="form" onsubmit="editUser({$user.id}); return false;">
                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="dateBirth">Data Nascimento:</label>
                            <input class="form-control" id="dateBirth">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="contact">Contacto:</label>
                            <input class="form-control" id="contact">
                        </div>
                    </form>
                    <div class="alert alert-danger alert-dismissible" style="display: none;" role="alert" id="friendStatus">
                        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        Failed to complete the action! Please verify the information.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <input id="EditProfileSubmit" type="submit" class="btn btn-primary" form="editFriendForm"></input>
                </div>                
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->