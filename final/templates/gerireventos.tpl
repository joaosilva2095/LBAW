{include file='common/header.tpl'}

<body>
    {include file='common/navbar.tpl'}

    <div class="container-fluid">
        <div class="row">
            {include file='common/sidebar_adm.tpl' selected='gerireventos'}

            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Gerir Eventos</h1>
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
                                    <!-- Administrador options -->
                                    {if $viewer.role === 'Administrador'}
                                    <i data-toggle="modal" data-target="#addEventModal">
                                                <i class="fa fa-pencil fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Editar"></i>
                                    </i>
                                    <i class="fa fa-trash fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Eliminar"></i>
                                    <!-- Contabilista options -->
                                    {elseif $viewer.role === 'Contabilista'}
                                    <i data-toggle="modal" data-target="#addUserAttendanceEventModal">
                                        <i class="fa fa-user-plus fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Adicionar Presença"></i>
                                    </i>{/if}
                                </td>
                                <td style="display:none;">
                                    <!-- Friends that went to the event -->
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                {if $viewer.role === 'Contabilista'}
                                                <th>Opções</th>
                                                {/if}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {foreach $event.friends as $key => $eventFriend}
                                            <tr id="eventFriend{$event.id|escape:'html'}-{$eventFriend.id|escape:'html'}">
                                                <td>{$eventFriend.id|escape:'html'}</td>
                                                <td>{$eventFriend.name|escape:'html'}</td>
                                                {if $viewer.role === 'Contabilista'}
                                                <td>
                                                    <i class="fa fa-user-times fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Eliminar Presença"></i>
                                                </td>
                                                {/if}
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
                {if $viewer.role === 'Administrador'}
                <button id="newEvent" type="button" class="btn btn-default" data-toggle="modal" data-target="#addEventModal">
                    <i class="fa fa-calendar-plus-o"></i> Novo Evento
                </button>
                {/if}
            </div>
        </div>
    </div>

    <!-- Confirm Dialog -->
    {include file='modals/confirm_action.tpl'}

    <!-- Register / Edit event -->
    {include file='modals/add_event.tpl'}

    <!-- See event -->
    {include file='modals/see_event.tpl'}

    <!-- Add a friend to event -->
    {include file='modals/add_friend_event.tpl'}

    <!-- G.A.S.Porto -->
    <script src="{$BASE_URL}js/gerireventos.min.js "></script>

</body>

{include file='common/footer.tpl'}
