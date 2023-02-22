@extends('layouts.admin')

@section('title', 'Lista de Cosechas')

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
						<h4>Lista de Cosechas</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">
						@can('harvests.create')
						<div class="text-right">
							<a href="{{ route('harvests.create') }}" class="btn btn-sm btn-primary">Agregar</a>
						</div>
						@endcan

						<div class="table-responsive mb-4 mt-4">
							<table class="table table-hover table-export">
								<thead>
									<tr>
										<th>#</th>
										<th>Nombre</th>
										<th>Estado</th>
										@if(auth()->user()->can('harvests.edit') || auth()->user()->can('harvests.active') || auth()->user()->can('harvests.deactive') || auth()->user()->can('harvests.delete'))
										<th>Acciones</th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach($harvests as $harvest)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $harvest->name }}</td>
										<td>{!! state($harvest->state) !!}</td>
										@if(auth()->user()->can('harvests.edit') || auth()->user()->can('harvests.active') || auth()->user()->can('harvests.deactive') || auth()->user()->can('harvests.delete'))
										<td>
											<div class="btn-group" role="group">
												@can('harvests.edit')
												<a href="{{ route('harvests.edit', ['harvest' => $harvest->slug]) }}" class="btn btn-info btn-sm bs-tooltip mr-0" title="Editar"><i class="fa fa-edit"></i></a>
												@endcan
												@if($harvest->state=='Activo')
												@can('harvests.deactive')
												<button type="button" class="btn btn-warning btn-sm bs-tooltip mr-0" title="Desactivar" onclick="deactiveHarvest('{{ $harvest->slug }}')"><i class="fa fa-power-off"></i></button>
												@endcan
												@else
												@can('harvests.active')
												<button type="button" class="btn btn-success btn-sm bs-tooltip mr-0" title="Activar" onclick="activeHarvest('{{ $harvest->slug }}')"><i class="fa fa-check"></i></button>
												@endcan
												@endif
												@can('harvests.delete')
												<button type="button" class="btn btn-danger btn-sm bs-tooltip mr-0" title="Eliminar" onclick="deleteHarvest('{{ $harvest->slug }}')"><i class="fa fa-trash"></i></button>
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

@can('harvests.deactive')
<x-modal-simple modal="deactiveHarvest" form="formDeactiveHarvest" method="PUT" title="¿Estás seguro de que quieres desactivar esta cosecha?" close="Cancelar" button="Desactivar"></x-modal-simple>
@endcan

@can('harvests.active')
<x-modal-simple modal="activeHarvest" form="formActiveHarvest" method="PUT" title="¿Estás seguro de que quieres activar esta cosecha?" close="Cancelar" button="Activar"></x-modal-simple>
@endcan

@can('harvests.delete')
<x-modal-simple modal="deleteHarvest" form="formDeleteHarvest" method="DELETE" title="¿Estás seguro de que quieres eliminar esta cosecha?" close="Cancelar" button="Eliminar"></x-modal-simple>
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