@extends('components.layout')
	@section("title", "Récapitulatif {{ $date }}")

	@section('script')
		<script>
			function toggle_detail_retro()
			{
				if(!document.querySelector("#detail_retro").classList.contains('d-none'))
				{
					document.querySelector("#detail_retro").classList.add('d-none')
				}
				else
				{
					document.querySelector("#detail_retro").classList.remove('d-none')
				}
			}
		</script>
	@endsection

	@section('content')
	<h1>Récapitulatif {{ $date }}</h1>

	<form action="{{ route('recap') }}" method="GET">
		<div class="row mb-3">
			<div class="col">
				<label for="date_start">Date de début</label>
				<input type="date" class="form-control" value="{{ $date_start }}" name="date_start">
			</div>
			<div class="col">
				<label for="date_end">Date de fin</label>
				<input type="date" class="form-control" value="{{ $date_end }}" name="date_end">
			</div>
			<div class="col mt-4 d-grid gap-2">
				<button class="btn btn-primary btn-block">Rechercher</button>
			</div>
		</div>
	</form>

	@tab_recap(["paiements" => $paiements, "ca_brut" => $ca_brut, "retro" => $retro, "ca_net" => $ca_net, "cs" => $cs, "tab_retros" => $tab_retros])
	
	@endtab_recap
	@endsection