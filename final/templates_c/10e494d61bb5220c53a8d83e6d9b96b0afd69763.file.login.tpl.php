<?php /* Smarty version Smarty-3.1.15, created on 2016-05-11 15:33:09
         compiled from "/opt/lbaw/lbaw1532/public_html/final/templates/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20880276295730ae4dd04a84-76746073%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '10e494d61bb5220c53a8d83e6d9b96b0afd69763' => 
    array (
      0 => '/opt/lbaw/lbaw1532/public_html/final/templates/login.tpl',
      1 => 1462809352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20880276295730ae4dd04a84-76746073',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5730ae4ddcdee4_46827571',
  'variables' => 
  array (
    'BASE_URL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5730ae4ddcdee4_46827571')) {function content_5730ae4ddcdee4_46827571($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="G.A.S.Porto - Management Panel">
    <meta name="author" content="CodeCats @ LBAW">
    <link rel="icon" href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
img/favicon.ico">

    <title>G.A.S.Porto - Management Panel</title>

    <!-- Bootstrap -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
css/vendor/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- G.A.S.Porto -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
css/dashboard.min.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
css/login.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="row v-align">
        <div class="col-sm-3 h-align">
            <header class="page-title text-center">G.A.S.Porto</header>
            
            <form role="form" class="login-form" action="../actions/login.php" method="post">
                <div class="form-group">
                    <label for="username">Email:</label>
                    <input type="text" required="required" name="username" class="form-control" id="username" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" required="required" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="text-right">
                    <a href="#">Esqueceu a password?</a>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-default">Entrar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JQuery -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/vendor/bootstrap.min.js"></script>

    <!-- G.A.S.Porto -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
js/holder.min.js"></script>
</body>

<?php echo $_smarty_tpl->getSubTemplate ('common/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
