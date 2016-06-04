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
                {if $user.role != 'Amigo'}
				<th>Opções</th>
				{/if}
            </tr>
        </thead>
        <tbody>

            {foreach $mercha_payments as $entry}
            <tr id="mercha-{$entry.id}">
                <td style="display:none;">{$entry.id}</td>
                <!-- to be used on view modal -->
                <td style="display:none;">{$entry.payment_type}</td>
                <td>{$entry.payment_date}</td>
                <td>{$entry.value}</td>
                <td>{$entry.quantity}</td>
                <td>{$entry.description}</td>
                <td>{$entry.price}</td>
                <td><i class="fa fa-file-pdf-o fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Obter Fatura"></i></td>
                <td>
                    {if $user.role != 'Amigo'}
                    <i class="fa fa-trash fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Eliminar"></i>    {/if} 
                </td>
            </tr>
            {/foreach}

        </tbody>
    </table>
</div>