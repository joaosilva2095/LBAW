<hr class="sub-header">
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="display:none;">id</th>
				<th style="display:none;">payment_type</th>
                <th>Data</th>
                <th>Valor (EUR)</th>
                <th>Quantidade</th>
                <th>Produto</th>
                <th>Preço</th>
                <th>Fatura</th>
                {if $viewer.role !== 'Amigo'}
				<th>Opções</th>
				{/if}
            </tr>
        </thead>
        <tbody>

            {foreach $mercha_payments as $entry}
            <tr id="mercha-{$entry.id|escape:'html'}">
                <td style="display:none;">{$entry.id|escape:'html'}</td>
                <!-- to be used on view modal -->
                <td style="display:none;">{$entry.payment_type|escape:'html'}</td>
                <td>{$entry.payment_date|escape:'html'}</td>
                <td>{$entry.value|escape:'html'}</td>
                <td>{$entry.quantity|escape:'html'}</td>
                <td>{$entry.description|escape:'html'}</td>
                <td>{$entry.price|escape:'html'}</td>
                <td><i class="fa fa-file-pdf-o fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Obter Fatura"></i></td>
                <td>
                    {if $viewer.role !== 'Amigo'}
                    <i class="fa fa-trash fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Eliminar"></i>    {/if} 
                </td>
            </tr>
            {/foreach}

        </tbody>
    </table>
</div>