@extends('layouts.admin')

@section('title', 'Lista de Usuarios')

@section('links')
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/custom_dt_html5.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/dt-global_style.css') }}">
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Lista de Usuarios</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">
						@can('users.create')
						<div class="text-right">
							<a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">Agregar</a>
						</div>
						@endcan

						<div class="table-responsive mb-4 mt-4">
							<table class="table table-hover table-export">
								<thead>
									<tr>
										<th>#</th>
										<th>Nombre Completo</th>
										<th>Correo</th>
										<th>Teléfono</th>
										<th>Tipo</th>
										<th>Estado</th>
										@if(auth()->user()->can('users.show') || auth()->user()->can('users.edit') || auth()->user()->can('users.active') || auth()->user()->can('users.deactive') || auth()->user()->can('users.delete'))
										<th>Acciones</th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach($users as $user)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td class="d-flex align-items-center">
											<img src="{{ $user->photo_url }}" class="rounded-circle mr-2" width="45" height="45" alt="{{ $user->fullname }}" title="{{ $user->fullname }}"> {{ $user->fullname }}
										</td>
										<td>{{ $user->email }}</td>
										<td>{{ $user->phone }}</td>
										<td>{!! roleUser($user) !!}</td>
										<td>{!! state($user->state) !!}</td>
										@if(auth()->user()->can('users.show') || auth()->user()->can('users.edit') || auth()->user()->can('users.active') || auth()->user()->can('users.deactive') || auth()->user()->can('users.delete'))
										<td>
											<div class="btn-group" role="group">
												@can('users.show')
												<a href="{{ route('users.show', ['user' => $user->slug]) }}" class="btn btn-primary btn-sm bs-tooltip mr-0" title="Perfil"><i class="fa fa-user"></i></a>
												@endcan
												@can('users.edit')
												<a href="{{ route('users.edit', ['user' => $user->slug]) }}" class="btn btn-info btn-sm bs-tooltip mr-0" title="Editar"><i class="fa fa-edit"></i></a>
												@endcan
												@if(Auth::user()->id!=$user->id)
												@if($user->state=='Activo')
												@can('users.deactive')
												<button type="button" class="btn btn-warning btn-sm bs-tooltip mr-0" title="Desactivar" onclick="deactiveUser('{{ $user->slug }}')"><i class="fa fa-power-off"></i></button>
												@endcan
												@else
												@can('users.active')
												<button type="button" class="btn btn-success btn-sm bs-tooltip mr-0" title="Activar" onclick="activeUser('{{ $user->slug }}')"><i class="fa fa-check"></i></button>
												@endcan
												@endif
												@if(!$user->hasRole('Super Admin') || ($user->hasRole('Super Admin') && Auth::user()->hasRole('Super Admin')))
												@can('users.delete')
												<button type="button" class="btn btn-danger btn-sm bs-tooltip mr-0" title="Eliminar" onclick="deleteUser('{{ $user->slug }}')"><i class="fa fa-trash"></i></button>
												@endcan
												@endif
												@endif
											</div>
										</td>
										@endif
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>                                        
				</div>

			</div>
		</div>
	</div>

</div>

@can('users.deactive')
<x-modal-simple modal="deactiveUser" form="formDeactiveUser" method="PUT" title="¿Estás seguro de que quieres desactivar este usuario?" close="Cancelar" button="Desactivar"></x-modal-simple>
@endcan

@can('users.active')
<x-modal-simple modal="activeUser" form="formActiveUser" method="PUT" title="¿Estás seguro de que quieres activar este usuario?" close="Cancelar" button="Activar"></x-modal-simple>
@endcan

@can('users.delete')
<x-modal-simple modal="deleteUser" form="formDeleteUser" method="DELETE" title="¿Estás seguro de que quieres eliminar este usuario?" close="Cancelar" button="Eliminar"></x-modal-simple>
@endcan

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/jszip.min.js') }}"></script>    
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/button-ext/buttons.print.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection