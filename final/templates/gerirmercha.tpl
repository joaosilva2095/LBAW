{include file='common/header.tpl'}

<body>
{include file='common/navbar.tpl'}

<div class="container-fluid">
    <div class="row">
        {include file='common/sidebar_adm.tpl' selected='gerirmercha'}

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Gerir Merchandising
                {if $viewer.role === 'Administrador'}
                    <button id="DelCat" type="button" class="btn btn-default pull-right margin-left-small" data-toggle="modal"
                            data-target="#delCatModal">
                        <i class="fa fa-trash"></i> Remover Categoria
                    </button>
                    <button id="newCat" type="button" class="btn btn-default pull-right margin-left-small" data-toggle="modal"
                            data-target="#newCatModal">
                        <i class="fa fa-user-plus"></i> Nova Categoria
                    </button>
                    <button id="newMercha" type="button" class="btn btn-default pull-right margin-left-small" data-toggle="modal"
                            data-target="#addMerchaModal">
                        <i class="fa fa-user-plus"></i> Novo Produto
                    </button>
                {/if}
            </h1>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Categoria</th>
                        <th>Descrição</th>
                        <th>Valor (EUR)</th>
                        <th>Opções</th>
                    </tr>
                    </thead>
                    <tbody id="merchas">

                    {foreach $merchas as $mercha}
                        <tr id="mercha{$mercha.id}">
                            <td>{$mercha.id|escape:'html'}</td>
                            <td>{$mercha.name|escape:'html'}</td>
                            <td>{$mercha.description|escape:'html'}</td>
                            <td>{$mercha.price|escape:'html'}</td>
                            <td>
                                {if $viewer.role === 'Administrador'}
                                    <i class="fa fa-pencil fa-lg fa-fw clickable" data-toggle="tooltip"
                                       data-original-title="Editar"></i>
                                    <i class="fa fa-trash fa-lg fa-fw clickable" data-toggle="tooltip"
                                       data-original-title="Eliminar"></i>
                                {elseif $viewer.role === 'Contabilista'}
                                    <i class="fa fa-shopping-cart fa-lg fa-fw clickable" data-toggle="tooltip"
                                       data-original-title="Adicionar Compra"></i>
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

<!-- Confirm Dialog -->
{include file='modals/confirm_action.tpl'}

{if $viewer.role === "Administrador"}
    <!-- Add/Edit Modal -->
    {include file='modals/addMercha.tpl' categories=$categories}
    {include file='modals/manageCategories.tpl' categories=$categories}
{elseif $viewer.role === "Contabilista"}
    {include file='modals/buyProduct.tpl'}
{/if}

<!-- G.A.S.Porto -->
<script src="{$BASE_URL}js/gerirmercha.js "></script>

</body>

{include file='common/footer.tpl'}
