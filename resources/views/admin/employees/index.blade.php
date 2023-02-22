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
							<a href="{{ route('employees.create') }}" class="btn btn-sm btn-primary">Agregar</a>
						</div>
						@endcan

						<div class="table-responsive mb-4 mt-4">
							<table class="table table-hover table-export">
								<thead>
									<tr>
										<th>#</th>
										<th>Nombre Completo</th>
										<th>Email</th>
										<th>Teléfono</th>
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
											<img src="{{ $employee->photo_url }}" class="rounded-circle mr-2" width="45" height="45" alt="{{ $employee->fullname }}" title="{{ $employee->fullname }}"> {{ $employee->fullname }}
										</td>
										<td>{{ $employee->email }}</td>
										<td>{{ $employee->phone }}</td>
										<td>{{ $employee->birthday->format('d-m-Y') }}</td>
										<td>{{ $employee->license }}</td>
										<td>{!! state($employee->state) !!}</td>
										@if(auth()->user()->can('employees.show') || auth()->user()->can('employees.edit') || auth()->user()->can('employees.active') || auth()->user()->can('employees.deactive') || auth()->user()->can('employees.delete'))
										<td>
											<div class="btn-group" role="group">
												@can('employees.show')
												<a href="{{ route('employees.show', ['employee' => $employee->slug]) }}" class="btn btn-primary btn-sm bs-tooltip mr-0" title="Perfil"><i class="fa fa-user"></i></a>
												@endcan
												@can('employees.edit')
												<a href="{{ route('employees.edit', ['employee' => $employee->slug]) }}" class="btn btn-info btn-sm bs-tooltip mr-0" title="Editar"><i class="fa fa-edit"></i></a>
												@endcan
												@if($employee->state=='Activo')
												@can('employees.deactive')
												<button type="button" class="btn btn-warning btn-sm bs-tooltip mr-0" title="Desactivar" onclick="deactiveEmployee('{{ $employee->slug }}')"><i class="fa fa-power-off"></i></button>
												@endcan
												@else
												@can('employees.active')
												<button type="button" class="btn btn-success btn-sm bs-tooltip mr-0" title="Activar" onclick="activeEmployee('{{ $employee->slug }}')"><i class="fa fa-check"></i></button>
												@endcan
												@endif
												@can('employees.delete')
												<button type="button" class="btn btn-danger btn-sm bs-tooltip mr-0" title="Eliminar" onclick="deleteEmployee('{{ $employee->slug }}')"><i class="fa fa-trash"></i></button>
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
<x-modal-simple modal="deactiveEmployee" form="formDeactiveEmployee" method="PUT" title="¿Estás seguro de que quieres desactivar este trabajador?" close="Cancelar" button="Desactivar"></x-modal-simple>
@endcan

@can('employees.active')
<x-modal-simple modal="activeEmployee" form="formActiveEmployee" method="PUT" title="¿Estás seguro de que quieres activar este trabajador?" close="Cancelar" button="Activar"></x-modal-simple>
@endcan

@can('employees.delete')
<x-modal-simple modal="deleteEmployee" form="formDeleteEmployee" method="DELETE" title="¿Estás seguro de que quieres eliminar este trabajador?" close="Cancelar" button="Eliminar"></x-modal-simple>
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