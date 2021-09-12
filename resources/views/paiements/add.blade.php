@extends('components.layout')

	@section("title", "Ajouter une consultation")
	@section("link")
		<link href="{{ asset('/css/tom-select.css') }}" rel="stylesheet">
	@endsection

	@section("script")
		<script src="{{ asset('/js/tom-select.complete.min.js') }}"></script>
		<script type="text/javascript">
			let config = {
				allowEmptyOption: true
			}
			
			new TomSelect(".selectpicker_clients", config);
			new TomSelect(".selectpicker_methode", config);
			new TomSelect(".selectpicker_osteo", config);

			function new_client()
			{
				document.querySelector("#new_client").classList.remove('d-none')
			}
		</script>
	@endsection

	@section('content')
	<h1>Ajouter une consultation</h1>
	
	<form action="{{ route('add_consultation') }}" method="POST">
		@csrf

		<div class="mb-3">
			<label for="clients">Client **</label>
			<select class="selectpicker_clients @error('clients_id') is-invalid @enderror" name="clients_id">
				<option value="">---</option>
				@foreach ($clients as $client)
					<option value="{{ $client->clients_id }}">{{ $client->clients_nom }} {{ $client->clients_prenom }}</option>
				@endforeach
			</select>
			<div class="form-text"><a href="#" onclick="new_client(); return false;">Ajouter un client</a></div>
		</div>

		<div id="new_client" class="mb-3 d-none">
			<div class="row">
				<div class="col">
					<label for="clients_nom">Nom</label>
					<input type="text" name="clients_nom" class="form-control @error('clients_nom') is-invalid @enderror" value="{{ old('clients_nom') }}">
				</div>
				<div class="col">
					<label for="clients_prenom">Prénom</label>
					<input type="text" name="clients_prenom" class="form-control @error('clients_prenom') is-invalid @enderror" value="{{ old('clients_prenom') }}">
				</div>
			</div>
		</div>

		<div class="mb-3">
			<div class="row">
				<div class="col">
					<label for="paiements_montant">Montant *</label>
					<input type="text" name="paiements_montant" value="{{ old('paiements_montant') ?? 60 }}" class="form-control @error('paiements_montant') is-invalid @enderror">
				</div>
				<div class="col">
					<label for="paiements_date">Date *</label>
					<input type="date" name="paiements_date" value="{{ old('paiements_date') ?? $date }}" class="form-control @error('paiements_date') is-invalid @enderror">
				</div>
			</div>
		</div>

		<div class="mb-3">
			<div class="row">
				<div class="col">
					<label for="paiements_methode">Méthode de paiement *</label>
					<select class="selectpicker_methode" name="paiements_methode">
						@foreach ($payment_method as $methode)
							<option value="{{ $methode->paiementsmethode_id }}">{{ $methode->paiementsmethode_label }}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<label for="osteo">Ostéo *</label>
					<select class="selectpicker_osteo @error('paiements_user') is-invalid @enderror" name="paiements_user">
						@foreach ($users as $user)
							<option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->name }}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>

		<div class="mb-3">
			<button class="btn btn-primary">Ajouter</button>
		</div>
	</form>
	@endsection