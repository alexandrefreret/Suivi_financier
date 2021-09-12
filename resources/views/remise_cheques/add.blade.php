@extends('components.layout')

	@section("title", "Ajouter une consultation")
	@section("link")
		<link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.3/dist/css/tom-select.css" rel="stylesheet">
	@endsection

	@section("script")
		<script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.3/dist/js/tom-select.complete.min.js"></script>
		<script type="text/javascript">
			let config = {
				allowEmptyOption: true,
				plugins: {
					remove_button:{
						title:'Supprimer cet item',
					}
				}
			}
			
			new TomSelect(".selectpicker_paiement", config);
		</script>
	@endsection

	@section('content')
	<h1>Ajouter une consultation</h1>
	
	<form action="{{ route('add_remise_cheques') }}" method="POST">
		@csrf

		<div class="mb-3">
			<label for="clients">Paiements *</label>
			<select class="selectpicker_paiement @error('paiements_ids') is-invalid @enderror" name="paiements_ids[]" multiple >
				<option value="">---</option>
				@foreach ($paiements as $paiement)
					<option value="{{ $paiement->paiements_id }}">{{ $paiement->clients->clients_nom }} {{ $paiement->clients->clients_prenom }} ({{ $paiement->paiements_montant}}€ - {{ $paiement->paiements_date->format('d/m/Y') }})</option>
				@endforeach
			</select>
		</div>

		<div class="mb-3">
			<div class="row">
				<div class="col">
					<label for="remisecheques_numero">Numéro *</label>
					<input type="text" name="remisecheques_numero" value="{{ old('remisecheques_numero') }}" class="form-control @error('remisecheques_numero') is-invalid @enderror">
				</div>
				<div class="col">
					<label for="remisecheques_date">Date *</label>
					<input type="date" name="remisecheques_date" value="{{ old('remisecheques_date') ?? $date }}" class="form-control @error('remisecheques_date') is-invalid @enderror">
				</div>
			</div>
		</div>

		<div class="mb-3">
			<button class="btn btn-primary">Ajouter</button>
		</div>
	</form>
	@endsection