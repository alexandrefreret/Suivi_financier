<div class="table-responsive mb-3">
	<table class="table table-striped table-bordered">
		<tbody>
			<tr>
				<td>CA brut : {{ $ca_brut }}€</td>
				<td>Rétro : {{ $retro }}€</td>
			</tr>
			<tr>
				<td>CA net : {{ $ca_net }}€</td>
				<td>CS : {{ $cs }}€</td>
			</tr>
		</tbody>
	</table>
</div>

@if(count($tab_retros) > 1)
<div class="row mb-3">
	<div class="col">
		<a href="#" onclick="toggle_detail_retro(); return false;">Voir le détail des rétros</a>
		<div id="detail_retro" class="d-none">
			<table class="table table-striped table-bordered">
				<tbody>
					@foreach ($tab_retros as $retros)
						<tr>
							<td>{{ $retros["user"] }}</td>
							<td>{{ $retros["montant"] }}€</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endif

<div class="row">
	<div class="col">
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Clients</th>
						<th>Montant</th>
						<th>Date</th>
						<th>Méthode</th>
						<th>Rétro man</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($paiements as $paiement)
					<tr>
						<td>{{ $paiement->clients->clients_nom }} {{ $paiement->clients->clients_prenom }}</td>
						<td>{{ $paiement->paiements_montant }}€</td>
						<td>{{ $paiement->paiements_date->format('d/m/Y') }}</td>
						<td>
							{{ $paiement->methode->paiementsmethode_label }}
							@if($paiement->remise_cheques != null)
							<br>Remise n°{{ $paiement->remise_cheques->remisecheques_numero }}
							@endif
						</td>
						<td>{{ $paiement->user->name }} {{ $paiement->user->firstname }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>