<?php /* Smarty version Smarty-3.1.15, created on 2016-05-09 17:55:55
         compiled from "/opt/lbaw/lbaw1532/public_html/final/templates/common/sidebar_adm.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16526707655730ae491accf0-80333074%%*/
if (!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array(
    'file_dependency' =>
        array(
            '71541711af35200208cd7f102cedf600d9bd5408' =>
                array(
                    0 => '/opt/lbaw/lbaw1532/public_html/final/templates/common/sidebar_adm.tpl',
                    1 => 1462809352,
                    2 => 'file',
                ),
        ),
    'nocache_hash' => '16526707655730ae491accf0-80333074',
    'function' =>
        array(),
    'version' => 'Smarty-3.1.15',
    'unifunc' => 'content_5730ae491c6916_71879239',
    'variables' =>
        array(
            'BASE_URL' => 0,
        ),
    'has_nocache_code' => false,
), false); /*/%%SmartyHeaderCode%%*/ ?>
<?php if ($_valid && !is_callable('content_5730ae491c6916_71879239')) {
    function content_5730ae491c6916_71879239($_smarty_tpl)
    { ?>
        <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value; ?>
pages/homepageadmin.php">Visao Geral</a></li>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value; ?>
pages/gerirpessoal.php">Gerir Pessoal</a></li>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value; ?>
pages/gerirmercha.php">Gerir Merchandising</a></li>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value; ?>
pages/gerireventos.php">Eventos</a></li>
        </ul>
        </div><?php }
} ?>
