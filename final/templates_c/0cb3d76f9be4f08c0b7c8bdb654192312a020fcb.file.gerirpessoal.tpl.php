<?php /* Smarty version Smarty-3.1.15, created on 2016-05-09 17:55:55
         compiled from "/opt/lbaw/lbaw1532/public_html/final/templates/gerirpessoal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21096728215730ae4904c941-21528714%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0cb3d76f9be4f08c0b7c8bdb654192312a020fcb' => 
    array (
      0 => '/opt/lbaw/lbaw1532/public_html/final/templates/gerirpessoal.tpl',
      1 => 1462809352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21096728215730ae4904c941-21528714',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5730ae49148db7_88625104',
  'variables' => 
  array (
    'users' => 0,
    'user' => 0,
    'BASE_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5730ae49148db7_88625104')) {function content_5730ae49148db7_88625104($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('common/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<body>
    <?php echo $_smarty_tpl->getSubTemplate ('common/navbar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


    <div class="container-fluid">
        <div class="row">
            <?php echo $_smarty_tpl->getSubTemplate ('common/sidebar_adm.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Gerir Pessoal</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Data Nascimento</th>
                                <th>Cargo</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody id="users">

                            <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['user']->key;
?>

                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['user']->value['birth'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['user']->value['role'];?>
</td>
                                <td>
                                    <i class="fa fa-pencil fa-lg fa-fw" data-toggle="tooltip" data-original-title="Editar"></i>
                                    <i class="fa fa-briefcase fa-lg fa-fw" data-toggle="tooltip" data-original-title="Alterar Cargo"></i>
                                    <i class="fa fa-trash fa-lg fa-fw" data-toggle="tooltip" data-original-title="Eliminar"></i>
                                </td>
                            </tr>

                            <?php } ?>

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
                                    <option>Referencia Bancaria</option>
                                    <option>Numerario</option>
                                    <option>Transferencia Bancaria</option>
                                    <option>Debito Directo</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="freq">Frequencia de Pagamento</label>
                                <select class="form-control" id="periodicity" required="required">
                                    <option>Semanal</option>
                                    <option>Mensal</option>
                                    <option>Trimestral</option>
                                    <option>Semestral</option>
                                    <option>Anual</option>
                                </select>
                            </div>
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
    <script src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/vendor/jquery.min.js"></script>

    <!-- JQuery UI -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/vendor/jquery-ui.min.js"></script>
    
    <!-- Bootstrap -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/vendor/bootstrap.min.js"></script>

    <!-- G.A.S.Porto -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/holder.min.js"></script>

    <!-- G.A.S.Porto -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/gerirpessoal.min.js"></script>
</body>

<?php echo $_smarty_tpl->getSubTemplate ('common/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
