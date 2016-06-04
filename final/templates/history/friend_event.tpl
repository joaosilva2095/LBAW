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
			<tr id="Evento-{$entry.id}">
				<td style="display:none;">{$entry.id}</td>
				<!-- to be used on view modal -->
				<td style="display:none;">{$entry.description}</td>
				<td style="display:none;">{$entry.duration}</td>
				<td style="display:none;">{$entry.place}</td>
				<td>{$entry.event_date}</td>
				<td>{$entry.name}</td>
				<td>{$entry.price}</td>
				<td>				
					<i data-toggle="modal" data-target="#seeEventModal">
					<i class="fa fa-eye fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Detalhes"></i>
					</i>
					{if $user.role != 'Amigo'}
					<i class="fa fa-trash fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Eliminar"></i> {/if}
				</td>
			</tr>
			{/foreach}

		</tbody>
	</table>
</div>

{include file='modals/see_event_history.tpl'}