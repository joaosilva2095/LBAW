{include file='common/header.tpl'}

<body>
    {include file='common/navbar.tpl'}

    <div class="container-fluid">
        <div class="row">
             {include file='common/sidebar_adm.tpl'}
             
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">{$user.name}</h1>

                <div class="row placeholders">
                
                    <div class="col-sm-3 text-left">
                        <div class="row">
                            <h4>Data Nascimento:</h4>
                            <p>{$user.birth}</p>
                        </div>
                        <div class="row">
                            <h4>Email:</h4>
                            <p>{$user.email}</p>
                        </div>
                        <div class="row">
                            <h4>Contacto:</h4>
                            <p>{$user.cellphone}</p>
                        </div>
                        <div class="row">
                            <h4>Método de pagamento:</h4>
                            <p>{$user.donative_type}</p>
                        </div>
                        <div class="row">
                            <h4>Frequência de pagamento:</h4>
                            <p>{$user.periodicity}</p>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1 placeholder text-justify" id="settings">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4><i class="fa fa-cogs fa-lg fa-fw panel-title"></i>Ferramentas</h4>
                            </div>
                            <div class="panel-body">
                                <a data-toggle="modal" data-target="#editProfile">
                                    <h6><i class="fa fa-pencil fa-lg fa-fw"></i>Editar perfil</h6>
                                </a>
                                <a data-toggle="modal" data-target="#methPayment">
                                    <h6><i class="fa fa-credit-card fa-lg fa-fw"></i>Editar metodo de pagamento</h6>
                                </a>
                                <a>
                                    <div class="container" id="accordion">
                                        <h6 data-toggle="collapse" data-parent="#accordion" href="#ref"><i class="fa fa-search fa-lg fa-fw"></i>Ver referência de multibanco</h6>

                                        <div id="ref" class="collapse">
                                            <h6> 2562548641200056532 </h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <h2>Histórico</h2>
                <hr class="sub-header">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Data</th>
                                <th>Tipo</th>
                                <th>Valor (EUR)</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            {foreach $history as $entry}
                        
                            <tr>
                                <td>{$entry.id}</td>
                                <td>{$entry.date}</td>
                                <td>{$entry.type}</td>                                                 
                                <td>{$entry.value}</td>
                                
                                <td><i class="fa fa-file-pdf-o fa-lg fa-fw" data-toggle="tooltip" data-original-title="Imprimir Recibo"></i></td>
                                
                                {if $entry.type eq "Evento"}
                                <td> <i class="fa fa-calendar fa-lg fa-fw" data-toggle="tooltip" data-original-title="Ver evento"></i></td>                                                            
                                {else}
                                <td></td>
                                {/if}
                            </tr>
                            
                            {/foreach}
                                                       
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

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
                    <form role="form">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Modal -->
    <div id="methPayment" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" for="sel1">metodo de pagamento</h4>
                </div>
                <div class="modal-body">
                    <select class="form-control" id="sel1">
                        <option value="referencia multibanco">referencia multibanco</option>
                        <option value="debito direto">debito direto</option>
                        <option value="transferência bancária">transferência bancária</option>
                        <option value="cheque">cheque</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

 <!-- JQuery -->
    <script src="{$BASE_URL}js/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="{$BASE_URL}js/vendor/bootstrap.min.js"></script>

    <!-- G.A.S.Porto -->
    <script src="{$BASE_URL}js/holder.min.js"></script>

    <!-- G.A.S.Porto -->
    <script src="{$BASE_URL}js/gerirpessoal.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip({
                placement: 'top'
            });
        });
    </script>

</body>

{include file='common/footer.tpl'}