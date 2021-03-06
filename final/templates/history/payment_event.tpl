<hr class="sub-header">
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="display:none;">id</th>
				<th style="display:none;">receipt</th>
                <th>Data</th>
                <th>Nome do Evento</th>
                <th>Valor (EUR)</th>
                <th>Referência ATM </th>
                <th>Fatura</th>
                {if $viewer.role !== 'Amigo'}
				<th>Opções</th>
				{/if}
            </tr>
        </thead>
        <tbody>

            {foreach $event_payment_history as $entry}
            <tr id="eventoPayment-{$entry.id|escape:'html'}">
                <td style="display:none;">{$entry.id|escape:'html'}</td>
                <!-- to be used to output receipt -->
                <td style="display:none;">{$entry.receipt|escape:'html'}</td>
                <!-- to be used on view modal -->
                <td>{$entry.payment_date|escape:'html'}</td>
                <td>{$entry.name|escape:'html'}</td>
                <td>{$entry.value|escape:'html'}</td>
                <td>{$entry.atm_reference|escape:'html'}</td>
                
                <td>
                {if !is_null($entry.receipt)}
                <a href="{$BASE_URL}receipts/{$entry.receipt}"><i class="fa fa-file-pdf-o fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Obter Fatura"></i></a>
                {/if}
                </td>
                <td>
                    {if $viewer.role !== 'Amigo'}
                    <i data-toggle="modal" data-target="#editEventPaymentModal">
                        <i class="fa fa-pencil fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Editar"></i>
                    </i>
                    <i class="fa fa-trash fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Eliminar"></i>    {/if}
                </td>
            </tr>
            {/foreach}

        </tbody>
    </table>
</div>

{include file='modals/edit_payment_event.tpl'}