{include file='common/header.tpl'}

<body>
    {include file='common/navbar.tpl'}

    <div class="container-fluid">
        <div class="row">
            {include file='common/sidebar_adm.tpl'}

            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Gerir Pessoal</h1>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nome</th>
                                <th>Data Nascimento</th>
                                <th>Cargo</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            {foreach $users as $key => $user}
                            
                            <tr>
                                <td>{$user.id}</td>
                                <td>{$user.name}</td>
                                <td>{$user.birth}</td>
                                <td>{$user.role}</td>
                                <td><i class="fa fa-pencil fa-lg fa-fw" data-toggle="tooltip" data-original-title="Editar"></i> <i class="fa fa-briefcase fa-lg fa-fw" data-toggle="tooltip" data-original-title="Alterar Cargo"></i> <i class="fa fa-trash fa-lg fa-fw"
                                        data-toggle="tooltip" data-original-title="Eliminar"></i></td>
                            </tr>
                            
                            {/foreach}
                            
                        </tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#registerUser"><i class="fa fa-user-plus"></i> Novo Utilizador</button>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="registerUser">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Novo utilizador</h4>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input class="form-control" id="name" required="required">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" required="required">
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Data de Nascimento:</label>
                            <input type="date" class="form-control" id="birthdate" required="required">
                        </div>
                        <div class="form-group">
                            <label for="cellphone">Telemóvel:</label>
                            <input type="tel" class="form-control" id="cellphone" required="required">
                        </div>
                        <div class="form-group">
                            <label for="role">Cargo:</label>
                            <select class="form-control" id="role" required="required">
                            <option>Amigo</option>
                            <option>Adminitrador</option>
                            <option>Contabilista</option>
                        </select>
                        </div>

                        <div class="form-group">
                            <label for="paymethod">Metodo de Pagamento:</label>
                            <select class="form-control" id="paymethod" required="required">
                            <option>Referencia Bancaria</option>
                            <option>Numerario</option>
                            <option>Transferencia Bancaria</option>
                            <option>Debito Directo</option>
                        </select>
                        </div>

                        <div class="form-group">
                            <label for="freq">Frequencia de Pagamento</label>
                            <select class="form-control" id="freq" required="required">
                            <option>Semanal</option>
                            <option>Mensal</option>
                            <option>Trimestral</option>
                            <option>Semestral</option>
                            <option>Anual</option>
                        </select>
                        </div>
                        <div class="form-group">
                            <label for="donation">Valor da Doação:</label>
                            <input type="number" class="form-control" id="donation" value="0.00" />
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="registerUserSubmit">Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- JQuery -->
    <script src="{$BASE_URL}javascript/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="{$BASE_URL}javascript/vendor/bootstrap.min.js"></script>

    <!-- G.A.S.Porto -->
    <script src="{$BASE_URL}javascript/holder.min.js"></script>
    
    <!-- G.A.S.Porto -->
    <script src="{$BASE_URL}javascript/gerirpessoal.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip({
                placement: 'top'
            });
        });
    </script>
</body>

{include file='common/footer.tpl'}