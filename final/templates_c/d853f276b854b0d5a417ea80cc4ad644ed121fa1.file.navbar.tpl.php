<?php /* Smarty version Smarty-3.1.15, created on 2016-05-09 17:55:55
         compiled from "/opt/lbaw/lbaw1532/public_html/final/templates/common/navbar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:863655255730ae49167662-21463009%%*/
if (!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array(
    'file_dependency' =>
        array(
            'd853f276b854b0d5a417ea80cc4ad644ed121fa1' =>
                array(
                    0 => '/opt/lbaw/lbaw1532/public_html/final/templates/common/navbar.tpl',
                    1 => 1462809352,
                    2 => 'file',
                ),
        ),
    'nocache_hash' => '863655255730ae49167662-21463009',
    'function' =>
        array(),
    'version' => 'Smarty-3.1.15',
    'unifunc' => 'content_5730ae491a74b3_90426954',
    'variables' =>
        array(
            'user' => 0,
            'notifications' => 0,
            'notification' => 0,
            'BASE_URL' => 0,
        ),
    'has_nocache_code' => false,
), false); /*/%%SmartyHeaderCode%%*/ ?>
<?php if ($_valid && !is_callable('content_5730ae491a74b3_90426954')) {
    function content_5730ae491a74b3_90426954($_smarty_tpl)
    { ?>
        <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">G.A.S.Porto</a>
            </div>

            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><i
                                class="fa fa-user"></i> <?php echo $_smarty_tpl->tpl_vars['user']->value['name']; ?>
                            (<?php echo $_smarty_tpl->tpl_vars['user']->value['role']; ?>
                            )</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i>
                            Notificações <span
                                class="badge"><?php echo count($_smarty_tpl->tpl_vars['notifications']->value); ?>
</span></a>

                        <ul class="dropdown-menu list-group">

                            <?php $_smarty_tpl->tpl_vars['notification'] = new Smarty_Variable;
                            $_smarty_tpl->tpl_vars['notification']->_loop = false;
                            $_from = $_smarty_tpl->tpl_vars['notifications']->value;
                            if (!is_array($_from) && !is_object($_from)) {
                                settype($_from, 'array');
                            }
                            foreach ($_from as $_smarty_tpl->tpl_vars['notification']->key => $_smarty_tpl->tpl_vars['notification']->value) {
                                $_smarty_tpl->tpl_vars['notification']->_loop = true;
                                ?>

                                <li class="list-group-item list-group-item-<?php echo $_smarty_tpl->tpl_vars['notification']->value['type']; ?>
"><?php echo $_smarty_tpl->tpl_vars['notification']->value['description']; ?>
                                </li>

                            <?php } ?>

                        </ul>

                    </li>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value; ?>
actions/logout.php"><i class="fa fa-lock"></i> Sair</a></li>
                </ul>
                <form class="navbar-form navbar-right" action="pesquisa.html" method="GET">
                    <input type="text" class="form-control" placeholder="Search...">
                </form>
            </div>
        </div>
        </nav><?php }
} ?>
