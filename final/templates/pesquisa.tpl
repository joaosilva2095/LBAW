{include file='common/header.tpl'}

<body>
    {include file='common/navbar.tpl'}

    <div class="container-fluid">
        <div class="row">
            {include file='common/sidebar_adm.tpl'}

            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Resultados Pesquisa</h1> {if isset($name_users)}
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
                                <td>{$user.id}</td>
                                <td>{$user.name}</td>
                                <td>{$user.birth}</td>
                                <td>{$user.role}</td>
                                <td>
                                    <i class="fa fa-pencil fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Editar"></i>
                                    <i class="fa fa-briefcase fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Alterar Cargo"></i>
                                    <i class="fa fa-trash fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Eliminar"></i>
                                </td>
                            </tr>

                            {/foreach}

                        </tbody>
                    </table>
                </div>
                {/if} {if isset($atm_users)}
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
                                <td>{$user.atm_reference}</td>
                                <td>{$user.id}</td>
                                <td>{$user.name}</td>
                                <td>{$user.birth}</td>
                                <td>{$user.role}</td>
                                <td>
                                    <i class="fa fa-pencil fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Editar"></i>
                                    <i class="fa fa-briefcase fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Alterar Cargo"></i>
                                    <i class="fa fa-trash fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Eliminar"></i>
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

    <!-- JQuery -->
    <script src="{$BASE_URL}js/vendor/jquery.min.js"></script>

    <!-- JQuery UI -->
    <script src="{$BASE_URL}js/vendor/jquery-ui.min.js"></script>
    <!-- Bootstrap -->
    <script src="{$BASE_URL}js/vendor/bootstrap.min.js"></script>

    <!-- G.A.S.Porto -->
    <script src="{$BASE_URL}js/holder.min.js"></script>
</body>

{include file='common/footer.tpl'}
