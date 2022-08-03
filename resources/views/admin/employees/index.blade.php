@extends('layouts.admin')

@section('title', 'Lista de Trabajadores')

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
						<h4>Lista de Trabajadores</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">
						@can('employees.create')
						<div class="text-right">
							<a href="{{ route('employees.create') }}" class="btn btn-primary">Agregar</a>
						</div>
						@endcan

						<div class="table-responsive mb-4 mt-4">
							<table class="table table-hover table-export">
								<thead>
									<tr>
										<th>#</th>
										<th>Nombre Completo</th>
										<th>Correo</th>
										<th>Fecha de Nacimiento</th>
										<th>Licencia</th>
										<th>Estado</th>
										@if(auth()->user()->can('employees.show') || auth()->user()->can('employees.edit') || auth()->user()->can('employees.active') || auth()->user()->can('employees.deactive') || auth()->user()->can('employees.delete'))
										<th>Acciones</th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach($employees as $employee)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td class="d-flex align-items-center">
											<img src="{{ image_exist('/admins/img/users/', $employee->photo, true) }}" class="rounded-circle mr-2" width="45" height="45" alt="{{ $employee->name." ".$employee->lastname }}" title="{{ $employee->name." ".$employee->lastname }}"> {{ $employee->name." ".$employee->lastname }}
										</td>
										<td>{{ $employee->email }}</td>
										<td>{{ $employee->birthday->format('d-m-Y') }}</td>
										<td>{{ $employee->license }}</td>
										<td>{!! state($employee->state) !!}</td>
										@if(auth()->user()->can('employees.show') || auth()->user()->can('employees.edit') || auth()->user()->can('employees.active') || auth()->user()->can('employees.deactive') || auth()->user()->can('employees.delete'))
										<td>
											<div class="btn-group" role="group">
												@can('employees.show')
												<a href="{{ route('employees.show', ['employee' => $employee->slug]) }}" class="btn btn-primary btn-sm bs-tooltip" title="Perfil"><i class="fa fa-user"></i></a>
												@endcan
												@can('employees.edit')
												<a href="{{ route('employees.edit', ['employee' => $employee->slug]) }}" class="btn btn-info btn-sm bs-tooltip" title="Editar"><i class="fa fa-edit"></i></a>
												@endcan
												@if($employee->state=='Activo')
												@can('employees.deactive')
												<button type="button" class="btn btn-warning btn-sm bs-tooltip" title="Desactivar" onclick="deactiveEmployee('{{ $employee->slug }}')"><i class="fa fa-power-off"></i></button>
												@endcan
												@else
												@can('employees.active')
												<button type="button" class="btn btn-success btn-sm bs-tooltip" title="Activar" onclick="activeEmployee('{{ $employee->slug }}')"><i class="fa fa-check"></i></button>
												@endcan
												@endif
												@can('employees.delete')
												<button type="button" class="btn btn-danger btn-sm bs-tooltip" title="Eliminar" onclick="deleteEmployee('{{ $employee->slug }}')"><i class="fa fa-trash"></i></button>
												@endcan
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

@can('employees.deactive')
<div class="modal fade" id="deactiveEmployee" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Estás seguro de que quieres desactivar este trabajador?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Cancelar</button>
				<form action="#" method="POST" id="formDeactiveEmployee">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-primary">Desactivar</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endcan

@can('employees.active')
<div class="modal fade" id="activeEmployee" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Estás seguro de que quieres activar este trabajador?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Cancelar</button>
				<form action="#" method="POST" id="formActiveEmployee">
					@csrf
					@method('PUT')
					<button type="submit" class="btn btn-primary">Activar</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endcan

@can('employees.delete')
<div class="modal fade" id="deleteEmployee" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">¿Estás seguro de que quieres eliminar este trabajador?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Cancelar</button>
				<form action="#" method="POST" id="formDeleteEmployee">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-primary">Eliminar</button>
				</form>
			</div>
		</div>
	</div>
</div>
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