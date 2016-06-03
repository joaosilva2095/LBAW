<div class="container">
    <h2>Histórico</h2></div>

<div id="Tabs" class="container">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#1" data-toggle="tab">Ida a Eventos</a>
        </li>
        <li><a href="#2" data-toggle="tab">Pagamento Eventos</a>
        </li>
        <li><a href="#3" data-toggle="tab">Donativos</a>
        </li>
        <li><a href="#4" data-toggle="tab">Merchandise</a>
        </li>
    </ul>

    <div class="tab-content ">
        <div class="tab-pane active" id="1">
            {include file='history/friend_event.tpl'}
        </div>
        <div class="tab-pane" id="2">
            {include file='history/payment_event.tpl'}
        </div>
        <div class="tab-pane" id="3">
            {include file='history/donative.tpl'}
        </div>

        <div class="tab-pane" id="4">
            {include file='history/mercha.tpl'}
        </div>
    </div>
</div>