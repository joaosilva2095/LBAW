<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            {if $viewer.role !== 'Amigo'}
            <a class="navbar-brand" href="homepage.php">G.A.S.Porto</a> {else}
            <a class="navbar-brand" href="amigo.php">G.A.S.Porto</a> {/if}
        </div>

        <p id="meID" style="display:none;">{$viewer.id}</p>
        <p id="meEmail" style="display:none;">{$viewer.email}</p>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                {if $viewer.role === "Amigo"}
                <li><a id="UserNameNav" href="amigo.php"><i class="fa fa-user"></i>{$viewer.name|escape:'html'}
                        ({$viewer.role|escape:'html'})</a></li>{else}
                <li><a id="UserNameNav" href="homepage.php"><i class="fa fa-user"></i>{$viewer.name|escape:'html'}
                        ({$viewer.role|escape:'html'})</a></li>{/if}
                <li id="notifications" class="dropdown">
                    <a href="#" class="dropdown-toggle"><i class="fa fa-bell"></i> Notificações
                        <span class="badge">{$notifications|@count}</span></a>

                    <ul class="dropdown-menu list-group">

                        {foreach $notifications as $notification}
                        <li id="notification{$notification.id|escape:'html'}" class="list-group-item list-group-item-{$notification.notification_type|@strtolower}">{$notification.description}</li>
                        {/foreach}
                    </ul>
                </li>

                <li id="navsettings" class="dropdown">
                    <a href="" class="dropdown-toggle" onclick="return false"> <i class="fa fa-cog" aria-hidden="true"></i> Opções </a>

                    <ul class="dropdown-menu list-group">
                        <li class="clickable" id="EditCredentials" data-toggle="modal" data-target="#editCredentialsModal">
                            <a>
                                <i class="fa fa-pencil fa-lg fa-fw"></i> Editar Credenciais
                            </a>
                        </li>
                        <li><a href="{$BASE_URL}actions/logout.php"><i class="fa fa-sign-out"></i> Sair</a></li>
                    </ul>
                </li>

            </ul>
            {if $viewer.role !== "Amigo"}
            <form class="navbar-form navbar-right" role="search" action="pesquisa.php" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Procurar" name="search">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
            {/if}
        </div>
    </div>
</nav>

<script src="{$BASE_URL}js/common/navbar.min.js"></script>

{include file="modals/edit_credentials.tpl"}
