@extends('components.layout')
	@section("title", "Récapitulatif mensuel {{ $mois }}")

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
	<h1>Récapitulatif mensuel {{ $mois }}</h1>

	

	@tab_recap(["paiements" => $paiements, "ca_brut" => $ca_brut, "retro" => $retro, "ca_net" => $ca_net, "cs" => $cs, "tab_retros" => $tab_retros])
	
	@endtab_recap
	@endsection