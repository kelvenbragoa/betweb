<!DOCTYPE html>
<html lang="pt">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="SISTEMA PRODUZIDO PARA CODELABS">
	<meta name="author" content="CODELABS">
	<meta name="keywords" content="SISTEMA PRODUZIDO PARA CODELABS">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	<link rel="shortcut icon" href="{{asset('files/img/sys/logocdm.png')}}" />
  	
	  
  	
	
	<link href="{{asset('template/css/app.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('toastr.min.css')}}" />
	
	<title>CodeLabs</title>
</head>

<body>
	<div id="app" class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<router-link class="sidebar-brand" to="/company/dashboard">
          			<span class="align-middle">CodeLabs Empresa</span>
        		</router-link>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Páginas
					</li>

					<li class="sidebar-item">
						<router-link class="sidebar-link" to="/company/dashboard">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Painel Geral</span>
						</router-link>
					</li>
					

					<li class="sidebar-header">
						Gestão
					</li>

					
					 <li class="sidebar-item">
						<router-link class="sidebar-link" to="/company/stevedors">
							<i class="align-middle" data-feather="codepen"></i> <span class="align-middle">Estivadores</span>
						</router-link>
					</li>

					

					<li class="sidebar-item">
						<router-link class="sidebar-link" to="/company/transactions">
							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Transações</span>
						</router-link>
					</li>

					
				
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
					<i class="hamburger align-self-center"></i>
				</a>

				
				<ul class="navbar-nav d-none d-lg-flex">
					<li class="nav-item px-2 dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="megaDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
							aria-expanded="false">
							Mega Menu
						</a>
						<div class="dropdown-menu dropdown-menu-start dropdown-mega" aria-labelledby="megaDropdown">
							<div class="d-md-flex align-items-start justify-content-start">
								<div class="dropdown-mega-list">
									<div class="dropdown-header">Cadastros</div>
									<router-link to="/company/stevedors/create" class="dropdown-item" >Estivadores</router-link>
									<router-link to="/company/transactions/create" class="dropdown-item" >Transações</router-link>
								
									
								</div>
								<div class="dropdown-mega-list">
									<div class="dropdown-header">Páginas</div>
									<router-link to="/company/stevadors" class="dropdown-item" >Estivadores</router-link>
									<router-link to="/company/transactions" class="dropdown-item" >Transações</router-link>
									
								</div>
							
							</div>
						</div>
					</li>

					
					
				</ul>


				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="bell"></i>
									<span class="indicator">{{Auth::user()->notifications->count()}}</span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
									{{Auth::user()->notifications->count()}} Novas notificações
								</div>

								<div class="list-group">

									

									
								</div>

								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Mostrar todas notificações</a>
								</div>
							</div>
						</li>
						
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
								<i class="align-middle" data-feather="settings"></i>
							</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
								<img src="{{asset('files/img/sys/logocdm.png')}}" class="avatar img-fluid rounded mr-2" alt="{{Auth()->user()->name}}" /> <span class="text-dark">{{Auth()->user()->name}}</span>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
							
								
								<div class="dropdown-divider"></div>
								<form action="{{route('logout')}}" id="form" method="POST">
									@csrf
								  <button type="submit" class="btn btn-outline-primary mx-3 mt-2 d-block">Sair</button>
								  </form>
							
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<router-view></router-view>

				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-left">
							<p class="mb-0">
								<a href="#" class="text-muted"><strong>CodeLabs</strong></a> &copy; {{ date('Y')}}
							</p>
						</div>
						<div class="col-6 text-right">
							<ul class="list-inline">
								
								<li class="list-inline-item">
									<router-link to="/company/dashboard" class="text-muted" href="#">CodeLabs</router-link>
								</li>
								
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="{{asset('template/js/app.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<script>
		window.user = {!! Auth::user() !!}
	</script>
</body>

</html>