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
                <li><a href="#"><i class="fa fa-user"></i> {$user.name} ({$user.role})</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Notificações
                        <span class="badge">{$notifications|@count}</span></a>

                    <ul class="dropdown-menu list-group">

                        {foreach $notifications as $notification}
                            <li class="list-group-item list-group-item-{$notification.notification_type|@strtolower}">{$notification.description}</li>
                        {/foreach}

                    </ul>

                </li>
                <li><a href="{$BASE_URL}actions/logout.php"><i class="fa fa-lock"></i> Sair</a></li>
            </ul>
            <form class="navbar-form navbar-right" role="search" action="pesquisa.php" method="GET">
                <input name="user" type="text" class="form-control" placeholder="Search...">
            </form>
        </div>
    </div>
</nav>
