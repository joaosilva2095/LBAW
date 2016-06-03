{include file='common/header.tpl'}

<body>
    {include file='common/navbar.tpl'}

    <div class="container-fluid">
        <div class="row">
            {include file='common/sidebar_adm.tpl'}

            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Gerir Pessoal</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Género</th>
                                <th>Data Nascimento</th>
                                <th>Telemóvel</th>
                                <th>NIF</th>
                                <th>Tipo Donativo</th>
                                <th>Periodicidade</th>
                                <th>Cargo</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody id="users">

                            {foreach $users as $key => $user} {if $user.role === 'Amigo' && $user.frozen}
                            <tr class="warning" id="user{$user.id}">
                                {else}
                                <tr id="user{$user.id}">
                                    {/if}
                                    <td>{$user.id}</td>
                                    <td>{$user.name}</td>
                                    <td>{$user.email}</td>
                                    <td>{$user.gender}</td>
                                    <td>{$user.birth}</td>
                                    {if $user.role === 'Amigo'}
                                    <td>{$user.cellphone}</td>
                                    <td>{$user.nif}</td>
                                    <td>{$user.donative_type}</td>
                                    <td>{$user.periodicity}</td>
                                    {else}
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    {/if}
                                    <td>{$user.role}</td>
                                    <td>
                                        <a href="user.php?user={$user.id}" class="fa fa-eye fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Ver"></a>
                                        <i data-toggle="modal" data-target="#notificationModal">
                                            <i class="fa fa-bullhorn fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Notificar"></i>
                                        </i>
                                        {if $role === 'Administrador'}
                                        <i data-toggle="modal" data-target="#userModal">
                                                <i class="fa fa-pencil fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Editar"></i>
                                        </i>
                                        <i class="fa fa-trash fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Eliminar"></i> {elseif $role === 'Contabilista' && $user.role === 'Amigo'} {if $user.frozen}
                                        <i id="user{$user.id}-frozen" class="fa fa-play fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Descongelar"></i> {else}
                                        <i id="user{$user.id}-frozen" class="fa fa-pause fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Congelar"></i> {/if} {/if}
                                    </td>
                                </tr>
                                {/foreach}

                        </tbody>
                    </table>
                </div>
                {if $role === 'Administrador'}
                <button id="newUser" type="button" class="btn btn-default" data-toggle="modal" data-target="#userModal">
                    <i class="fa fa-user-plus"></i> Novo Utilizador
                </button>
                {/if}
            </div>
        </div>
    </div>

    <!-- Register / Edit user -->
    {include file='modals/add_user.tpl'}

    <!-- Notification -->
    {include file='modals/add_notification.tpl'}

    <!-- JQuery -->
    <script src="{$BASE_URL}js/vendor/jquery.min.js "></script>

    <!-- JQuery UI -->
    <script src="{$BASE_URL}js/vendor/jquery-ui.min.js "></script>

    <!-- Bootstrap -->
    <script src="{$BASE_URL}js/vendor/bootstrap.min.js "></script>

    <!-- G.A.S.Porto -->
    <script src="{$BASE_URL}js/gerirpessoal.min.js "></script>

</body>

{include file='common/footer.tpl'}
