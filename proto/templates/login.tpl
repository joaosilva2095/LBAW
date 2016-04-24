<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="G.A.S.Porto - Login">
    <meta name="author" content="CodeCats @ LBAW">
    <link rel="icon" href="img/favicon.ico">

    <title>G.A.S.Porto - Login</title>

    <!-- Bootstrap -->
    <link href="../css/vendor/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- G.A.S.Porto -->
    <link href="../css/login.css" rel="stylesheet">

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

            <form role="form" class="login-form" action="../actions/login.php" method="get">
                <div class="form-group">
                    <label for="username">Usuário:</label>
                    <input type="text" required="required" class="form-control" id="username" placeholder="Usuário">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" required="required" class="form-control" id="password" placeholder="Password">
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
    <script src="../js/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="../js/vendor/bootstrap.min.js"></script>

    <!-- G.A.S.Porto -->
    <script src="../js/holder.min.js"></script>
</body>

</html>