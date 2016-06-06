{include file='common/header.tpl'}

<!-- Navigation Bar -->
{include file='common/navbar.tpl'}

<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">
        {include file='common/sidebar_adm.tpl'}

        <div class="col-sm-9 col-md-10 main">
            <!-- Toggle Sidebar Button-->
            <p class="visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">
                    <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                </button>
            </p>

            <h1 class="page-header">Resultados Pesquisa</h1>
            <!-- Users Result -->
            {if isset($name_users)}
            <h3 class="page-header">Utilizadores</h3>
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

                        {foreach $name_users as $key => $user}
                        <tr id="user{$user.id}">
                            <td>{$user.id|escape:'html'}</td>
                            <td>{$user.name|escape:'html'}</td>
                            <td>{$user.birth|escape:'html'}</td>
                            <td>{$user.role|escape:'html'}</td>
                            <td>
                                <a href="amigo.php?user={$user.id|escape:'html'}" class="fa fa-eye fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Ver"></a>
                            </td>
                        </tr>
                        {/foreach}

                    </tbody>
                </table>
            </div>
            {/if}
            <!-- Atm Reference Results -->
            {if isset($atm_users)}
            <h3 class="page-header">Referência Multibanco</h3>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Referência Multibanco</th>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Data Nascimento</th>
                            <th>Cargo</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody id="users">

                        {foreach $atm_users as $key => $user}
                        <tr id="user{$user.id}">
                            <td>{$user.atm_reference|escape:'html'}</td>
                            <td>{$user.id|escape:'html'}</td>
                            <td>{$user.name|escape:'html'}</td>
                            <td>{$user.birth|escape:'html'}</td>
                            <td>{$user.role|escape:'html'}</td>
                            <td>
                                <a href="amigo.php?user={$user.id|escape:'html'}" class="fa fa-eye fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Ver"></a>
                            </td>
                        </tr>
                        {/foreach}

                    </tbody>
                </table>
            </div>
            {/if}
            <!-- Events Results -->
            {if isset($events)}
            <h3 class="page-header">Eventos</h3>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="display:none;">Descrição</th>
                            <th>Nome</th>
                            <th>Data</th>
                            <th>Duração (H)</th>
                            <th>Local</th>
                            <th>Preço (€)</th>
                            <th>Opções</th>
                            <th style="display:none;">Participantes</th>
                        </tr>
                    </thead>
                    <tbody id="events">

                        {foreach $events as $key => $event}
                        <tr id="event{$event.id|escape:'html'}">
                            <td style="display:none;">{$event.description|escape:'html'}</td>
                            <td>{$event.name|escape:'html'}</td>
                            <td>{$event.event_date|escape:'html'}</td>
                            <td>{$event.duration|escape:'html'}</td>
                            <td>{$event.place|escape:'html'}</td>
                            <td>{$event.price|escape:'html'}</td>
                            <td>
                                <!-- Common options -->
                                <i data-toggle="modal" data-target="#seeEventModal">
                                    <i class="fa fa-eye fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Ver"></i>
                                </i>
                            </td>
                            <td style="display:none;">
                                <!-- Friends that went to the event -->
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {foreach $event.friends as $key => $eventFriend}
                                        <tr id="eventFriend{$event.id|escape:'html'}-{$eventFriend.id|escape:'html'}">
                                            <td>{$eventFriend.id|escape:'html'}</td>
                                            <td>{$eventFriend.name|escape:'html'}</td>
                                        </tr>
                                        {/foreach}
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        {/foreach}

                    </tbody>
                </table>
            </div>
            {/if}
        </div>
    </div>
</div>

<!-- See event -->
{include file='modals/see_event.tpl'}

<!-- G.A.S.Porto -->
<script src="{$BASE_URL}js/pesquisa.min.js "></script>

{include file='common/footer.tpl'}

