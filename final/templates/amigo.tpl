{include file='common/header.tpl'}

<body>
    {include file='common/navbar.tpl'}

    <div class="container-fluid">
        <div class="row">
            {if $viewer.role !== "Amigo"} {include file='common/sidebar_adm.tpl'} {/if}

            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 id="UserName" class="page-header">{$user.name|escape:'html'}</h1>
                
                <div class="row">

                    <div class="col-sm-3 col-md-4 text-left">
                        <div class="row">
                            <h4>Data Nascimento:</h4>
                            <p id="UserBirth">{$user.birth|escape:'html'}</p>
                        </div>
                        <div class="row">
                            <h4>Email:</h4>
                            <p id="UserEmail">{$user.email|escape:'html'}</p>
                        </div>
                        <div class="row">
                            <h4>Contacto:</h4>
                            <p id="UserCellphone">{$user.cellphone|escape:'html'}</p>
                        </div>
                        <div class="row">
                            <h4>Método de pagamento:</h4>
                            <p id="UserDonative">{$user.donative_type|escape:'html'}</p>
                        </div>
                        <div class="row">
                            <h4>Frequência de pagamento:</h4>
                            <p>{$user.periodicity|escape:'html'}</p>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-4 col-sm-offset-1 col-md-offset-1" id="settings">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4><i class="fa fa-cogs fa-lg fa-fw panel-title"></i>Ferramentas</h4>
                            </div>
                            <div class="panel-body">
                                <a data-toggle="modal" data-target="#editProfile">
                                    <h6 id="EditUserModal" class="clickable"><i class="fa fa-pencil fa-lg fa-fw"></i>Editar perfil</h6>
                                </a>
                                <a data-toggle="modal" data-target="#methPayment">
                                    <h6 id="EditPaymentModal" class="clickable"><i class="fa fa-credit-card fa-lg fa-fw"></i>Editar método de pagamento</h6>
                                </a>
                                <a>
                                    <div id="accordion">
                                        <h6 data-toggle="collapse" data-parent="#accordion" class="clickable"><i class="fa fa-search fa-lg fa-fw"></i>Ver referência atm do último pagamento efectuado</h6>
                                                
                                        <div id="ref" class="collapse">
                                            {if is_null($user_last_atm_reference) } <h6> (Vazio) </h6>
                                            {else} <h6>$user_last_atm_reference</h6>
                                            {/if}
                                            
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                {include file='history/history.tpl'}
            </div>
        </div>
    </div>

    {include file='modals/edit_profile_friend.tpl'} {include file='modals/edit_friend_payment.tpl'}



    <!-- G.A.S.Porto -->
    <script src="{$BASE_URL}js/amigo.min.js"></script>
</body>

{include file='common/footer.tpl'}