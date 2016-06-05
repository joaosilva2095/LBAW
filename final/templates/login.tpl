<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="G.A.S.Porto - Management Panel">
    <meta name="author" content="CodeCats @ LBAW">
    <link rel="icon" href="{$BASE_URL}img/favicon.ico">

    <title>G.A.S.Porto - Management Panel</title>

    <!-- Bootstrap -->
    <link href="{$BASE_URL}css/vendor/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- G.A.S.Porto -->
    <link href="{$BASE_URL}css/dashboard.min.css" rel="stylesheet">
    <link href="{$BASE_URL}css/login.min.css" rel="stylesheet">

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

            <form class="login-form" action="../actions/login.php" method="post">
                <div class="form-group">
                    <label for="username">Email:</label>
                    <input type="text" required="required" name="username" class="form-control" id="username" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" required="required" name="password" class="form-control" id="password" placeholder="Password">
                </div>

                {if isset($ERROR_MESSAGES)}
                <div class="alert alert-danger alert-dismissible" role="alert" id="registerStatus">
                    <button type="button" class="close" onclick="$('#registerStatus').fadeOut()" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    Login failed!
                </div>
                {/if}

                <div class="text-center">
                    <button type="submit" class="btn btn-default">Entrar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JQuery -->
    <script src="{$BASE_URL}js/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="{$BASE_URL}js/vendor/bootstrap.min.js"></script>

    <!-- G.A.S.Porto -->
    <script src="{$BASE_URL}js/holder.min.js"></script>
</body>

{include file='common/footer.tpl'}
