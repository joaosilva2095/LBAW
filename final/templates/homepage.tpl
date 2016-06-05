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
                        <canvas id="myChart" class="center-block" width="auto" height="200px"></canvas>
                        <h4>Pessoal</h4>
                    </div>
                    <div class="col-xs-12 col-sm-9 placeholder  hidden-xs">
                        <canvas id="earnings" class="center-block" width="auto" height="100px"></canvas>
                        <h4>Lucro</h4>
                    </div>
                </div>

                <h2 class="sub-header">Histórico</h2>
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
        </div>
    </div>

    <!-- Charts Core -->
    <script src="{$BASE_URL}js/vendor/chart.min.js"></script>

    <!-- Charts -->
    <script src="{$BASE_URL}js/charts.js"></script>


</body>

{include file='common/footer.tpl'}
