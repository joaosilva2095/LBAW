<!-- Register / Edit user modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="userModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="userModalTitle" class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="userForm">
                    <div class="form-group">
                        <label for="identification">ID:</label>
                        <input class="form-control" id="identification" required="required">
                    </div>
                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input class="form-control" id="name" required="required">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" required="required">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" required="required">
                    </div>
                    <div class="form-group">
                        <label for="gender">Género:</label>
                        <select class="form-control" id="gender" required="required">
                            <option>M</option>
                            <option>F</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="birthdate">Data de Nascimento:</label>
                        <input type="date" class="form-control" id="birthdate" required="required">
                    </div>
                    <div class="form-group">
                        <label for="role">Cargo:</label>
                        <select class="form-control" id="role" required="required">
                            <option>Amigo</option>
                            <option>Administrador</option>
                            <option>Contabilista</option>
                        </select>
                    </div>

                    <div id="friendOnlyParams">
                        <div class="form-group">
                            <label for="nif">NIF:</label>
                            <input class="form-control" id="nif" required="required">
                        </div>
                        <div class="form-group">
                            <label for="cellphone">Telemóvel:</label>
                            <input type="tel" class="form-control" id="cellphone" required="required">
                        </div>
                        <div class="form-group">
                            <label for="paymethod">Metodo de Pagamento:</label>
                            <select class="form-control" id="paymethod" required="required">
                                <option>Referência Multibanco</option>
                                <option>Numerário</option>
                                <option>Transferência Bancária</option>
                                <option>Débito Direto</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="freq">Frequencia de Pagamento</label>
                            <select class="form-control" id="periodicity" required="required">
                                <option>Mensal</option>
                                <option>Trimestral</option>
                                <option>Semestral</option>
                                <option>Anual</option>
                            </select>
                        </div>
                    </div>

                </form>
                <div class="alert alert-danger alert-dismissible" style="display: none;" role="alert" id="userStatus">
                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    Failed to complete the user action! Please verify the information.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" form="userForm" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
