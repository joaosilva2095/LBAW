<hr class="sub-header">
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Data</th>
                <th>Valor (EUR)</th>
                <th>Quantidade</th>
                <th>Produto</th>
                <th>Preço</th>
                <th>Fatura</th>
                <th>Opções</th>
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