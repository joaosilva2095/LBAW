{include file='common/header.tpl'}

<body>
{include file='common/navbar.tpl'}
<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">
        {include file='common/sidebar_adm.tpl' selected='visaogeral'}

        <div class="col-sm-9 col-md-10 main">
            <h1 class="page-header">Visão Geral</h1>

            <div class="row placeholders">
                <div class="col-xs-12 col-sm-3 placeholder  hidden-xs">
                    <canvas id="myChart" class="center-block" width="auto" height="200px"></canvas>
                    <h4>Pessoal</h4>
                </div>
                <div class="col-xs-12 col-sm-9 placeholder  hidden-xs">
                    <canvas id="earnings" class="center-block" width="auto" height="100px"></canvas>
                    <h4>Lucro</h4>
                </div>
            </div>
            <h2 class="sub-header">Detalhes</h2>

            <div id="Tabs" class="row">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active">
                        <a href="#UltimosPag" data-toggle="tab">Ultimos Pagamentos</a>
                    </li>
                    <li><a href="#DonativosAtr" data-toggle="tab">Donativos em Atraso</a>
                    </li>
                </ul>

                <div class="tab-content ">
                    <div role="tabpanel" class="tab-pane active" id="UltimosPag">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Utilizador</th>
                                    <th>Tipo</th>
                                    <th>Valor (EUR)</th>
                                </tr>
                                </thead>
                                <tbody>
                                {foreach $histories as $history}
                                    <tr>
                                        <td>{$history.payment_date|date_format:"%d-%m-%Y"}</td>
                                        <td>{$history.name}</td>
                                        <td>{$history.payment_type}</td>
                                        <td>{$history.value}</td>
                                    </tr>
                                {/foreach}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="DonativosAtr">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Ultimo Pagamento</th>
                                    <th>Utilizador</th>
                                    <th>Periodicidade</th>
                                    <th>Nr Donativos em atraso</th>
                                    <th>Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                {foreach $friendsNoPay as $friendNoPay}
                                    <tr id="user{$friendNoPay.id}">
                                        <td>{$friendNoPay.last_donative|date_format:"%d-%m-%Y"}</td>
                                        <td>{$friendNoPay.name}</td>
                                        <td>{$friendNoPay.periodicity}</td>
                                        <td>{$friendNoPay.numberofPayments}</td>
                                        <td>
                                            <a href="amigo.php?user={$friendNoPay.id|escape:'html'}"
                                               class="fa fa-eye fa-lg fa-fw clickable" data-toggle="tooltip"
                                               data-original-title="Ver"></a>
                                                <i data-toggle="modal" data-target="#notificationModal">
                                                    <i class="fa fa-bullhorn fa-lg fa-fw clickable"
                                                       data-toggle="tooltip"
                                                       data-original-title="Notificar"></i>
                                                </i>
                                            {if $viewer.role === 'Contabilista'}
                                                {if $friendNoPay.frozen}
                                                    <i id="user{$user.id|escape:'html'}-frozen"
                                                       class="fa fa-play fa-lg fa-fw clickable" data-toggle="tooltip"
                                                       data-original-title="Descongelar"></i>
                                                {else}
                                                    <i id="user{$friendNoPay.id|escape:'html'}-frozen"
                                                       class="fa fa-pause fa-lg fa-fw clickable" data-toggle="tooltip"
                                                       data-original-title="Congelar"></i>
                                                {/if}
                                            {/if}
                                        </td>
                                    </tr>
                                {/foreach}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Notification -->
{include file='modals/add_notification.tpl'}

<!-- Charts Core -->
<script src="{$BASE_URL}js/vendor/chart.min.js"></script>

<!-- Charts -->
<script src="{$BASE_URL}js/charts.js"></script>

<!-- Homepage -->
<script src="{$BASE_URL}js/homepage.js"></script>

</body>

{include file='common/footer.tpl'}