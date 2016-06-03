<hr class="sub-header">
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Data</th>
				<th>Nome</th>
				<th>Valor (EUR)</th>
				<th>Opções</th>
			</tr>
		</thead>
		<tbody>

			{foreach $event_history as $entry}
			<tr id="evento{$entry.id}">
				<td style="display:none;">{$entry.id}</td>  <!-- to be used on view modal -->
				<td style="display:none;">{$entry.description}</td>
				<td style="display:none;">{$entry.duration}</td>
				<td style="display:none;">{$entry.place}</td>
				<td>{$entry.event_date}</td>
				<td>{$entry.name}</td>
				<td>{$entry.price}</td>				
				<td>
					  <i class="fa fa-eye fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Detalhes"></i>
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