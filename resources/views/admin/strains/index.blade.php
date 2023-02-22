@extends('layouts.admin')

@section('title', 'Lista de Cepas')

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
						<h4>Lista de Cepas</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">
						@can('strains.create')
						<div class="text-right">
							<a href="{{ route('strains.create') }}" class="btn btn-sm btn-primary">Agregar</a>
						</div>
						@endcan

						<div class="table-responsive mb-4 mt-4">
							<table class="table table-hover table-export">
								<thead>
									<tr>
										<th>#</th>
										<th>Nombre</th>
										<th>Estado</th>
										@if(auth()->user()->can('strains.edit') || auth()->user()->can('strains.active') || auth()->user()->can('strains.deactive') || auth()->user()->can('strains.delete'))
										<th>Acciones</th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach($strains as $strain)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $strain->name }}</td>
										<td>{!! state($strain->state) !!}</td>
										@if(auth()->user()->can('strains.edit') || auth()->user()->can('strains.active') || auth()->user()->can('strains.deactive') || auth()->user()->can('strains.delete'))
										<td>
											<div class="btn-group" role="group">
												@can('strains.edit')
												<a href="{{ route('strains.edit', ['strain' => $strain->slug]) }}" class="btn btn-info btn-sm bs-tooltip mr-0" title="Editar"><i class="fa fa-edit"></i></a>
												@endcan
												@if($strain->state=='Activo')
												@can('strains.deactive')
												<button type="button" class="btn btn-warning btn-sm bs-tooltip mr-0" title="Desactivar" onclick="deactiveStrain('{{ $strain->slug }}')"><i class="fa fa-power-off"></i></button>
												@endcan
												@else
												@can('strains.active')
												<button type="button" class="btn btn-success btn-sm bs-tooltip mr-0" title="Activar" onclick="activeStrain('{{ $strain->slug }}')"><i class="fa fa-check"></i></button>
												@endcan
												@endif
												@can('strains.delete')
												<button type="button" class="btn btn-danger btn-sm bs-tooltip mr-0" title="Eliminar" onclick="deleteStrain('{{ $strain->slug }}')"><i class="fa fa-trash"></i></button>
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

@can('strains.deactive')
<x-modal-simple modal="deactiveStrain" form="formDeactiveStrain" method="PUT" title="¿Estás seguro de que quieres desactivar esta cepa?" close="Cancelar" button="Desactivar"></x-modal-simple>
@endcan

@can('strains.active')
<x-modal-simple modal="activeStrain" form="formActiveStrain" method="PUT" title="¿Estás seguro de que quieres activar esta cepa?" close="Cancelar" button="Activar"></x-modal-simple>
@endcan

@can('strains.delete')
<x-modal-simple modal="deleteStrain" form="formDeleteStrain" method="DELETE" title="¿Estás seguro de que quieres eliminar esta cepa?" close="Cancelar" button="Eliminar"></x-modal-simple>
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