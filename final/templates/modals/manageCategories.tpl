<div class="modal fade" tabindex="-1" role="dialog" id="newCatModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="newCatModalTitle" class="modal-title">Adicionar Categoria</h4>
            </div>
            <div class="modal-body">
                <form id="newCatForm">
                    <div class="form-group">
                        <label for="catName">Nome da Categoria:</label>
                        <input type="text" class="form-control" id="newCatName" required="required">
                    </div>
                </form>
                <div class="alert alert-danger alert-dismissible" style="display: none;" role="alert" id="newCatStatus">
                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    Erro a criar categoria! Por favor verifique as informações
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" form="newCatForm" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="delCatModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="delCatModalTitle" class="modal-title">Remover Categoria</h4>
            </div>
            <div class="modal-body">
                <form id="delCatForm">
                    <div class="form-group">
                        <label for="catName">Nome da Categoria:</label>
                        <select class="form-control" id="delCatName">
                            {foreach $categories as $category}
                                <option value="{$category.name}">{$category.name}</option>
                            {/foreach}
                        </select>
                    </div>
                </form>
                <div class="alert alert-danger alert-dismissible" style="display: none;" role="alert" id="delCatStatus">
                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    Erro a remover categoria! Por favor verifique as informações
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" form="delCatForm" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>




<script src="{$BASE_URL}js/modals/manageCategories.js"></script>
