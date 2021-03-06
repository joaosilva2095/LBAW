<hr class="sub-header">
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th style="display:none;">id</th>
				<th style="display:none;">description</th>
				<th style="display:none;">duration </th>
				<th style="display:none;">place</th>
				<th>Data</th>
				<th>Nome</th>
				<th>Valor (EUR)</th>
				<th>Opções</th>
			</tr>
		</thead>
		<tbody>

			{foreach $event_history as $entry}
			<tr id="Evento-{$entry.id|escape:'html'}">
				<td style="display:none;">{$entry.id|escape:'html'}</td>
				<!-- to be used on view modal -->
				<td style="display:none;">{$entry.description|escape:'html'}</td>
				<td style="display:none;">{$entry.duration|escape:'html'}</td>
				<td style="display:none;">{$entry.place|escape:'html'}</td>
				<td>{$entry.event_date|escape:'html'}</td>
				<td>{$entry.name|escape:'html'}</td>
				<td>{$entry.price|escape:'html'}</td>
				<td>				
					<i data-toggle="modal" data-target="#seeEventModal">
					<i class="fa fa-eye fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Detalhes"></i>
					</i>
					{if $viewer.role !== 'Amigo'}
					<i class="fa fa-trash fa-lg fa-fw clickable" data-toggle="tooltip" data-original-title="Eliminar"></i> {/if}
				</td>
			</tr>
			{/foreach}

		</tbody>
	</table>
</div>

{include file='modals/see_event_history.tpl'}