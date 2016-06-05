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
            </div>
        </div>
    </div>
</body>

{include file='common/footer.tpl'}
