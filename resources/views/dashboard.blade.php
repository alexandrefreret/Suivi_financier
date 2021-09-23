@extends('components.layout')
	@section('title', 'Dashboard')

	@section('script')
		<script src="{{ asset('js/chart.js') }}"></script>

		<script>
			const labels = [
				'Janvier',
				'Février',
				'Mars',
				'Avril',
				'Mai',
				'Juin',
				'Juillet',
				'Août',
				'Septembre',
				'Octobre',
				'Novembre',
				'Décembre',
			];

			const data = {
				labels: labels,
				datasets: [{
					label: 'Chiffre d\'affaire {{ $year_last }}',
					backgroundColor: 'rgb(56, 116, 237)',
					borderColor: 'rgb(56, 116, 237)',
					data: [{{ collect($tab_ca_last)->implode(',') }}],
				},{
					label: 'Chiffre d\'affaire {{ $year_current }}',
					backgroundColor: 'rgb(255, 99, 132)',
					borderColor: 'rgb(255, 99, 132)',
					data: [{{ collect($tab_ca)->implode(',') }}],
				}]
			};

			const data_patients = {
				labels: labels,
				datasets: [{
					label: 'Nombre de consultation {{ $year_last }}',
					backgroundColor: 'rgb(56, 116, 237)',
					borderColor: 'rgb(56, 116, 237)',
					data: [{{ collect($tab_patients_last)->implode(',') }}],
				},{
					label: 'Nombre de consultation {{ $year_current }}',
					backgroundColor: 'rgb(255, 99, 132)',
					borderColor: 'rgb(255, 99, 132)',
					data: [{{ collect($tab_patients)->implode(',') }}],
				}]
			};

			const data_new_patients = {
				labels: labels,
				datasets: [{
					label: 'Nombre de nouveaux patients {{ $year_last }}',
					backgroundColor: 'rgb(56, 116, 237)',
					borderColor: 'rgb(56, 116, 237)',
					data: [{{ collect($new_tab_patients_last)->implode(',') }}],
				},{
					label: 'Nombre de nouveaux patients {{ $year_current }}',
					backgroundColor: 'rgb(255, 99, 132)',
					borderColor: 'rgb(255, 99, 132)',
					data: [{{ collect($new_tab_patients)->implode(',') }}],
				}]
			};

			const config = {
				type: 'bar',
				data: data,
				options: {
					plugins: {
						title: {
							display: true,
							text: 'Evolution chiffre d\'affaire'
						}
					}
				}
			};

			const config_patient = {
				type: 'bar',
				data: data_patients,
				options: {
					plugins: {
						title: {
							display: true,
							text: 'Evolution du nombre de consultation'
						}
					}
				}
			};

			const config_new_patient = {
				type: 'bar',
				data: data_new_patients,
				options: {
					plugins: {
						title: {
							display: true,
							text: 'Evolution du nombre de nouveaux patients'
						}
					}
				}
			};

			var myChart = new Chart(
				document.getElementById('ca'),
				config
			);

			var myChart = new Chart(
				document.getElementById('patients'),
				config_patient
			);

			var myChart = new Chart(
				document.getElementById('new_patients'),
				config_new_patient
			);
		</script>
	@endsection

	@section('content')
		<h1>Tableau de bord</h1>
		
		<div class="row mt-5">
			<div class="col">
				<canvas id="ca"></canvas>
			</div>
			<div class="col">
				<canvas id="patients"></canvas>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col-6">
				<canvas id="new_patients"></canvas>
			</div>
		</div>
	@endsection