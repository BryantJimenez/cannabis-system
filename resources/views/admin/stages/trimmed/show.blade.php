@extends('layouts.admin')

@section('title', 'Detalles del Trimmiado')

@section('links')
<link href="{{ asset('/admins/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/custom_dt_html5.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/dt-global_style.css') }}">
@endsection

@section('content')

<div class="row">
	<div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">Datos del Trabajador</h3>
					@can('employees.edit')
					<a href="{{ route('employees.edit', ['employee' => $stage['user']->slug]) }}" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
					@endcan
				</div>
				<div class="text-center user-info">
					<img src="{{ image_exist('/admins/img/users/', $stage['user']->photo, true) }}" width="90" height="90" alt="Foto de perfil" title="{{ $stage['user']->name." ".$stage['user']->lastname }}">
					<p class="mb-0">{{ $stage['user']->name." ".$stage['user']->lastname }}</p>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled">
							<li class="contacts-block__item">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg>{!! roleUser($stage['user']) !!}
							</li>
							<li class="contacts-block__item">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>@if(!is_null($stage['user']->birthday)){{ $stage['user']->birthday->format('d-m-Y') }}@else{{ 'No Ingresado' }}@endif
							</li>
							<li class="contacts-block__item">
								<a href="mailto:{{ $stage['user']->email }}" class="text-break"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>{{ $stage['user']->email }}</a>
							</li>
							<li class="contacts-block__item">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>{{ $stage['user']->phone }}
							</li>
							<li class="contacts-block__item">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>@if(!is_null($stage['user']->license)){{ $stage['user']->license }}@else{{ 'No Ingresado' }}@endif
							</li>
							<li class="contacts-block__item">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>{!! state($stage['user']->state) !!}
							</li>
						</ul>
					</div>                                    
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-8 col-lg-6 col-md-6 col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">Detalles del Trimmiado</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Fecha:</b> {{ $stage->created_at->format("d-m-Y") }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Cepa:</b> {{ $stage['strain']->name }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Cuarto:</b> {{ $stage['room']->name }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Cosecha:</b> {{ $stage['harvest']->name }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Compartimento:</b> {{ $stage['container']->name }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Plantas en el Compartimento:</b> {{ $stage->plants_count }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Flor:</b> {{ number_format($stage->flower, 2, ',', '.').'g' }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Larf:</b> {{ number_format($stage->larf, 2, ',', '.').'g' }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Trim:</b> {{ number_format($stage->trim, 2, ',', '.').'g' }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Desperdicios:</b> {{ number_format($stage->waste, 2, ',', '.').'g' }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Nota:</b> @if(!is_null($stage->note)){{ $stage->note }}@else{{ 'No Ingresado' }}@endif</span>
							</li>
							<li class="contacts-block__item">
								<a href="{{ route('stages.trimmed.index') }}" class="btn btn-secondary">Volver</a>
							</li>
						</ul>
					</div>                                    
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">Plantas del Compartimento</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<div class="table-responsive">
									<table class="table table-normal table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>Código de Planta</th>
											</tr>
										</thead>
										<tbody>
											@foreach($stage['plants'] as $plant)
											<tr>
												<td>{{ $loop->iteration }}</td>
												<td>{{ $plant->code }}</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/table/datatable/datatables.js') }}"></script>
@endsection