@extends('layouts.admin')

@section('title', 'Lista de Compatimentos')

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
						<h4>Lista de Compatimentos</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">
						@can('containers.create')
						<div class="text-right">
							<a href="{{ route('containers.create') }}" class="btn btn-sm btn-primary">Agregar</a>
						</div>
						@endcan

						<div class="table-responsive mb-4 mt-4">
							<table class="table table-hover table-export">
								<thead>
									<tr>
										<th>#</th>
										<th>Nombre</th>
										<th>Uso</th>
										<th>Estado</th>
										@if(auth()->user()->can('containers.edit') || auth()->user()->can('containers.active') || auth()->user()->can('containers.deactive') || auth()->user()->can('containers.delete'))
										<th>Acciones</th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach($containers as $container)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $container->name }}</td>
										<td>{!! containerUse($container->use, $setting->qty_plants) !!}</td>
										<td>{!! state($container->state) !!}</td>
										@if(auth()->user()->can('containers.edit') || auth()->user()->can('containers.active') || auth()->user()->can('containers.deactive') || auth()->user()->can('containers.delete'))
										<td>
											<div class="btn-group" role="group">
												@can('containers.edit')
												<a href="{{ route('containers.edit', ['container' => $container->slug]) }}" class="btn btn-info btn-sm bs-tooltip mr-0" title="Editar"><i class="fa fa-edit"></i></a>
												@endcan
												@if($container->state=='Activo')
												@can('containers.deactive')
												<button type="button" class="btn btn-warning btn-sm bs-tooltip mr-0" title="Desactivar" onclick="deactiveContainer('{{ $container->slug }}')"><i class="fa fa-power-off"></i></button>
												@endcan
												@else
												@can('containers.active')
												<button type="button" class="btn btn-success btn-sm bs-tooltip mr-0" title="Activar" onclick="activeContainer('{{ $container->slug }}')"><i class="fa fa-check"></i></button>
												@endcan
												@endif
												@can('containers.delete')
												@if($container->use==0)
												<button type="button" class="btn btn-danger btn-sm bs-tooltip mr-0" title="Eliminar" onclick="deleteContainer('{{ $container->slug }}')"><i class="fa fa-trash"></i></button>
												@endif
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

@can('containers.deactive')
<x-modal-simple modal="deactiveContainer" form="formDeactiveContainer" method="PUT" title="¿Estás seguro de que quieres desactivar este compartimento?" close="Cancelar" button="Desactivar"></x-modal-simple>
@endcan

@can('containers.active')
<x-modal-simple modal="activeContainer" form="formActiveContainer" method="PUT" title="¿Estás seguro de que quieres activar este compartimento?" close="Cancelar" button="Activar"></x-modal-simple>
@endcan

@can('containers.delete')
<x-modal-simple modal="deleteContainer" form="formDeleteContainer" method="DELETE" title="¿Estás seguro de que quieres eliminar este compartimento?" close="Cancelar" button="Eliminar"></x-modal-simple>
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