<html>
	<head>
		<title>{{ $title ?? 'Dashboard' }}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
		@yield('link')

	</head>
	<body>
		<header class="p-3 mb-3 border-bottom">
			<div class="container">
				<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
					<a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
						
					</a>
			
					<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
						<li><a href="{{ route('dashboard') }}" class="nav-link px-2 link-secondary">Dashboard</a></li>
						<li><a href="{{ route('current_recap') }}" class="nav-link px-2 link-dark">Récap mensuel</a></li>
						<li><a href="{{ route('add_consultation_form') }}" class="nav-link px-2 link-dark">Saisir consultation</a></li>
						<li><a href="{{ route('remise_cheques') }}" class="nav-link px-2 link-dark">Remise chèques</a></li>
						<li><a href="{{ route('recap') }}" class="nav-link px-2 link-dark">Bilan</a></li>
					</ul>
			
					{{-- <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
						<input type="search" class="form-control" placeholder="Search..." aria-label="Search">
					</form> --}}
			
					{{-- <div class="dropdown text-end">
					<a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
						<img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
					</a>
					<ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="">
						<li><a class="dropdown-item" href="#">New project...</a></li>
						<li><a class="dropdown-item" href="#">Settings</a></li>
						<li><a class="dropdown-item" href="#">Profile</a></li>
						<li><hr class="dropdown-divider"></li>
						<li><a class="dropdown-item" href="#">Sign out</a></li>
					</ul>
					</div> --}}
				</div>
			</div>
		</header>

		<div class="container">
			@yield('content')
		</div>

		<script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
		@yield('script')
	</body>
</html>