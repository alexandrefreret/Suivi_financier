@extends('components.layout')
	@section('title', 'Remise de chèques')

	@section('content')

		<h1>Remise de chèques</h1>
		
		<div class="row mb-3">
			<div class="col">
				<a href="{{ route('remise_cheques_add_form') }}">Ajouter une remise</a>

			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Date</th>
								<th>Numéro</th>
								<th>Montant total</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($remise_cheques as $remise)
							<tr>
								<td>{{ $remise->remisecheques_date->format('d/m/Y') }}</td>
								<td>{{ $remise->remisecheques_numero }}</td>
								<td>{{ $remise->paiements->sum('paiements_montant') }}€</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

	@endsection