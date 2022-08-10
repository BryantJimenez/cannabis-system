@extends('layouts.admin')

@section('title', 'Inicio')

@section('content')

<div class="row layout-top-spacing">
	<div class="col-xl-6 col-lg-6 col-md-8 col-12 layout-spacing">
		<div class="card bg-primary">
			<div class="card-body">
				<h5 class="card-text text-white font-weight-bold">Bienvenido:</h5>
				<h6 class="text-white font-weight-bold">Administre todo su negocio de forma simple, fácil, comoda y a medida!</h6>
			</div>
		</div>
	</div>

	@can('users.index')
	<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 layout-spacing"> 
		<div class="card bg-secondary">
			<div class="card-body">
				<h5 class="card-text text-white text-center font-weight-bold">Usuarios</h5>
				<h2 class="text-white text-center font-weight-bold">{{ $users }}</h2>
			</div>
		</div>
	</div>
	@endcan

	@can('employees.index')
	<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 layout-spacing"> 
		<div class="card bg-secondary">
			<div class="card-body">
				<h5 class="card-text text-white text-center font-weight-bold">Trabajadores</h5>
				<h2 class="text-white text-center font-weight-bold">{{ $employees }}</h2>
			</div>
		</div>
	</div>
	@endcan

	@can('rooms.index')
	<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 layout-spacing"> 
		<div class="card bg-secondary">
			<div class="card-body">
				<h5 class="card-text text-white text-center font-weight-bold">Cuartos</h5>
				<h2 class="text-white text-center font-weight-bold">{{ $rooms }}</h2>
			</div>
		</div>
	</div>
	@endcan

	@can('strains.index')
	<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 layout-spacing"> 
		<div class="card bg-secondary">
			<div class="card-body">
				<h5 class="card-text text-white text-center font-weight-bold">Cepas</h5>
				<h2 class="text-white text-center font-weight-bold">{{ $strains }}</h2>
			</div>
		</div>
	</div>
	@endcan

	@can('containers.index')
	<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 layout-spacing"> 
		<div class="card bg-secondary">
			<div class="card-body">
				<h5 class="card-text text-white text-center font-weight-bold">Recipientes</h5>
				<h2 class="text-white text-center font-weight-bold">{{ $containers }}</h2>
			</div>
		</div>
	</div>
	@endcan
</div>

@endsection