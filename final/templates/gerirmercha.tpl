{include file='common/header.tpl'}

<body>
    {include file='common/navbar.tpl'}

    <div class="container-fluid">
        <div class="row">
            {include file='common/sidebar_adm.tpl'}

            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Gerir Merchandising</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Categoria</th>
                                <th>Descrição</th>
                                <th>Valor(EUR)</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody id="merchas">

                            {foreach $merchas as $mercha}
                            <tr id="mercha{$mercha.id}">
                                <td>{$mercha.id}</td>
                                <td>{$mercha.name}</td>
                                <td>{$mercha.description}</td>
                                <td>{$mercha.price}</td>
                                <td>
                                    <i class="fa fa-pencil fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Editar"></i>
                                    <i class="fa fa-trash fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Eliminar"></i>
                                </td>
                            </tr>
                            {/foreach}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirm Dialog -->
    {include file='modals/confirm_action.tpl'}
    
     <!-- Add/Edit Modal -->
    {include file='modals/addMercha.tpl' categories=$categories}

    <!-- G.A.S.Porto -->
    <script src="{$BASE_URL}js/gerirmercha.js "></script>


</body>

{include file='common/footer.tpl'}