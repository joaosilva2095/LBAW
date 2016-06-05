{include file='common/header.tpl'}

<body>
{include file='common/navbar.tpl'}
    <div class="container-fluid">
        <div class="row">
            {include file='common/sidebar_adm.tpl' selected='visaogeral'}

            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Visão Geral</h1>

                <div class="row placeholders">
                    <div class="col-xs-12 col-sm-3 placeholder  hidden-xs">
                        <canvas id="myChart" class="center-block" height="200"></canvas>
                        <h4>Pessoal</h4>
                    </div>
                    <div class="col-xs-12 col-sm-9 placeholder  hidden-xs">
                        <canvas id="earnings" class="center-block" height="100"></canvas>
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
                                            <td>{$history.payment_date|date_format:"%d-%m-%Y"|escape:'html'}</td>
                                            <td>{$history.name|escape:'html'}</td>
                                            <td>{$history.payment_type|escape:'html'}</td>
                                            <td>{$history.value|escape:'html'}</td>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {foreach $friendsNoPay as $friendNoPay}
                                        <tr>
                                            <td>{$friendNoPay.last_donative|date_format:"%d-%m-%Y"}</td>
                                            <td>{$friendNoPay.name}</td>
                                            <td>{$friendNoPay.periodicity}</td>
                                            <td>{$friendNoPay.numberofPayments}</td>
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

    <!-- Charts Core -->
    <script src="{$BASE_URL}js/vendor/chart.min.js"></script>

    <!-- Charts -->
    <script src="{$BASE_URL}js/charts.js"></script>


</body>

{include file='common/footer.tpl'}
