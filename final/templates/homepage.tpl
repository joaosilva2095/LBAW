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
                        <th>Descrição</th>
                        <th>Valor</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>2016-03-09</td>
                        <td>Diogo Moura</td>
                        <td>Doação</td>
                        <td>Mensalidade</td>
                        <td>50</td>
                    </tr>
                    <tr>
                        <td>2016-03-09</td>
                        <td>Sérgio Domingues</td>
                        <td>Evento</td>
                        <td>Jardim dos encantos</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <td>2016-03-09</td>
                        <td>Diogo Moura</td>
                        <td>Evento</td>
                        <td>Jardim dos Encantos</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <td>2015-12-26</td>
                        <td>Diogo Moura</td>
                        <td>Merchandising</td>
                        <td>Camisola Branca</td>
                        <td>15</td>
                    </tr>
                    <tr>
                        <td>2015-11-02</td>
                        <td>Sérgio Domingues</td>
                        <td>Evento</td>
                        <td>Jantar G.A.S.Porto</td>
                        <td>Grátis</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
       
<!-- JQuery -->
<script src="{$BASE_URL}js/vendor/jquery.min.js"></script>

<!-- Bootstrap ->
<script src="{$BASE_URL}js/vendor/bootstrap.min.js"></script> 

<!-- Charts Core -->
<script src="{$BASE_URL}js/vendor/chart.min.js"></script>

<!-- Charts -->
<script src="{$BASE_URL}js/charts.js"></script>

<!-- Confirm Dialog -->
{include file='modals/confirm_action.tpl'}

<!-- Register / Edit user -->
{include file='modals/add_user.tpl'}

<!-- Notification -->
{include file='modals/add_notification.tpl'}

<!-- G.A.S.Porto -->
<script src="{$BASE_URL}js/gerirpessoal.min.js "></script>

</body>

{include file='common/footer.tpl'}
