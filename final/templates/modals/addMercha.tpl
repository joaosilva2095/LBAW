<div class="modal fade" tabindex="-1" role="dialog" id="addMerchaModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 id="addMerchaModalTitle" class="modal-title">Adicionar Mercha</h4>
            </div>
            <div class="modal-body">
                <form id="addMerchaForm">
                        <input class="form-control hidden" id="id" disabled>
                    <div class="form-group">
                        <label for="category">Categoria:</label>
                        <select class="form-control" id="category">
                            {foreach $categories as $category}
                                <option value="{$category.name}">{$category.name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição:</label>
                        <input class="form-control" id="description" required="required">
                    </div>
                    <div class="form-group">
                        <label for="price">Preço:</label>
                        <input type="number" step="0.01" class="form-control" id="price" required="required">
                    </div>

                </form>
                <div class="alert alert-danger alert-dismissible" style="display: none;" role="alert" id="addMerchaStatus">
                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    Acao nao completada! Por favor verifique a informação
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" form="addMerchaForm" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script src="{$BASE_URL}js/modals/addMercha.js"></script>
