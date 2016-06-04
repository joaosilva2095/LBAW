<hr class="sub-header">
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Data</th>
                <th>Nome do Evento</th>
                <th>Valor (EUR)</th>
                <th>Referência ATM </th>
                <th>Fatura</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>

            {foreach $event_payment_history as $entry}
            <tr id="eventoPayment-{$entry.id}">
                <td style="display:none;">{$entry.id}</td>
                <!-- to be used to output receipt -->
                <td style="display:none;">{$entry.receipt}</td>
                <!-- to be used on view modal -->
                <td>{$entry.payment_date}</td>
                <td>{$entry.name}</td>
                <td>{$entry.value}</td>
                <td>{$entry.atm_reference}</td>
                <td><i class="fa fa-file-pdf-o fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Obter Fatura"></i></td>

                <td>
                    <i data-toggle="modal" data-target="#editEventPaymentModal">
                        <i class="fa fa-pencil fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Editar"></i>
                    </i>
                    <i class="fa fa-trash fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Eliminar"></i>

                    <!-- TODO    REMOVE   BELOW COMMENT TO REMOVE PRIVILEGES FROM FRIEND -->

                    <!--  {if $user.role != 'Amigo'}
                                        add above buttons (editentry + remove) here;
               {/if} -->
                </td>
            </tr>
            {/foreach}

        </tbody>
    </table>
</div>