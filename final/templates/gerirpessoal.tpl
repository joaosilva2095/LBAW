{include file='common/header.tpl'}

<body>
{include file='common/navbar.tpl'}

<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">
        {include file='common/sidebar_adm.tpl' selected='gerirpessoal'}

        <div class="col-sm-9 col-md-10 main">
            <h1 class="page-header">Gerir Pessoal
                {if $viewer.role === 'Administrador'}
                    <button id="newUser" type="button" class="btn btn-default pull-right" data-toggle="modal"
                            data-target="#addUserModal">
                        <i class="fa fa-user-plus"></i> Novo Utilizador
                    </button>
                {/if}
            </h1>
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
                        <tr class="warning" id="user{$user.id|escape:'html'}">
                            {else}
                        <tr id="user{$user.id|escape:'html'}">
                    {/if}
                        <td>{$user.id|escape:'html'}</td>
                        <td>{$user.name|escape:'html'}</td>
                        <td>{$user.email|escape:'html'}</td>
                        <td>{$user.gender|escape:'html'}</td>
                        <td>{$user.birth|escape:'html'}</td>
                        {if $user.role === 'Amigo'}
                            <td>{$user.cellphone|escape:'html'}</td>
                            <td>{$user.nif|escape:'html'}</td>
                            <td>{$user.donative_type|escape:'html'}</td>
                            <td>{$user.periodicity|escape:'html'}</td>
                        {else}
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        {/if}
                        <td>{$user.role|escape:'html'}</td>
                        <td>
                            <i data-toggle="modal" data-target="#notificationModal">
                                <i class="fa fa-bullhorn fa-lg fa-fw clickable" data-toggle="tooltip"
                                   data-original-title="Notificar"></i>
                            </i>
                            {if $viewer.role === 'Administrador'}
                                <i data-toggle="modal" data-target="#addUserModal">
                                    <i class="fa fa-pencil fa-lg fa-fw clickable" data-toggle="tooltip"
                                       data-original-title="Editar"></i>
                                </i>
                                <i class="fa fa-trash fa-lg fa-fw clickable" data-toggle="tooltip"
                                   data-original-title="Eliminar"></i>
                            {elseif $viewer.role === 'Contabilista' && $user.role === 'Amigo'}
                                <i data-toggle="modal" data-target="#addDonativeModal">
                                    <i class="fa fa-heart fa-lg fa-fw clickable" data-toggle="tooltip"
                                       data-original-title="Adicionar Donativo"></i>
                                </i>
                                {if $user.frozen}
                                    <i id="user{$user.id|escape:'html'}-frozen" class="fa fa-play fa-lg fa-fw clickable"
                                       data-toggle="tooltip" data-original-title="Descongelar"></i>
                                {else}
                                    <i id="user{$user.id|escape:'html'}-frozen"
                                       class="fa fa-pause fa-lg fa-fw clickable" data-toggle="tooltip"
                                       data-original-title="Congelar"></i>
                                {/if} {/if}
                        </td>
                        </tr>
                    {/foreach}

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Confirm Dialog -->
{include file='modals/confirm_action.tpl'}

<!-- Register / Edit user -->
{include file='modals/add_user.tpl'}

<!-- Add donative -->
{include file='modals/add_donative.tpl'}

<!-- Notification -->
{include file='modals/add_notification.tpl'}

<!-- G.A.S.Porto -->
<script src="{$BASE_URL}js/gerirpessoal.min.js "></script>

</body>

{include file='common/footer.tpl'}
