  <!-- Modal -->
    <div id="editCredentialsModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar Credenciais</h4>
                </div>
                <div class="modal-body">
                    <form id = "EditCredentialsForm" onsubmit="editCredentials('{$user.id}','{$user.email}'); return false;">
                        <div class="form-group">
                            <label for="editCredentialsFormName">Nome do utilizador:</label>
                            <input class="form-control" id="editCredentialsFormName">
                        </div>
                        <div class="form-group">
                            <label for="editCredentialsFormOldPw">Palavra-passe antiga:</label>
                            <input type="password" class="form-control" id="editCredentialsFormOldPw">
                        </div>
                        <div class="form-group">
                            <label for="editCredentialsFormNewPw">Nova palavra-passe:</label>
                            <input type="password" class="form-control" id="editCredentialsFormNewPw">
                        </div>  
                        <div class="form-group">
                            <label for="editCredentialsFormConfirmPw">Insira novamente a nova palavra-passe:</label>
                            <input type="password" class="form-control" id="editCredentialsFormConfirmPw">
                        </div>                     
                    </form>
                    <div class="alert alert-danger alert-dismissible" style="display: none;" role="alert" id="UserStatus1">
                        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        A edição falhou! Por favor verifique se preencheu correctamente os campos obrigatórios.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <input id="EditCredentialsSubmit" type="submit" class="btn btn-primary" form="EditCredentialsForm">
                </div>                
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->