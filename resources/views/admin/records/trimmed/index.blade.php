@extends('layouts.admin')

@section('title', 'Lista de Registros de Trimmiados')

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
						<h4>Lista de Registros de Trimmiados</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">
						<div class="table-responsive mb-4 mt-4">
							<table class="table table-hover table-normal">
								<thead>
									<tr>
										<th>#</th>
										@if(!Auth::user()->hasRole(['Trabajador']))
										<th>Trabajador</th>
										@endif
										<th>Cepa</th>
										<th>Cuarto</th>
										<th>Cosecha</th>
										<th>Compartimento</th>
										<th>Fecha</th>
										@if(auth()->user()->can('records.trimmed.show'))
										<th>Acciones</th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach($stages as $stage)
									<tr>
										<td>{{ $loop->iteration }}</td>
										@if(!Auth::user()->hasRole(['Trabajador']))
										<td class="d-flex align-items-center">
											<img src="{{ image_exist('/admins/img/users/', $stage['user']->photo, true) }}" class="rounded-circle mr-2" width="45" height="45" alt="{{ $stage['user']->name." ".$stage['user']->lastname }}" title="{{ $stage['user']->name." ".$stage['user']->lastname }}"> {{ $stage['user']->name." ".$stage['user']->lastname }}
										</td>
										@endif
										<td>{{ $stage['strain']->name }}</td>
										<td>{{ $stage['room']->name }}</td>
										<td>{{ $stage['harvest']->name }}</td>
										<td>{{ $stage['container']->name }}</td>
										<td>{{ $stage->created_at->format('d-m-Y') }}</td>
										@if(auth()->user()->can('records.trimmed.show'))
										<td>
											<div class="btn-group" role="group">
												@can('records.trimmed.show')
												<a href="{{ route('records.trimmed.show', ['stage' => $stage->id]) }}" class="btn btn-primary btn-sm bs-tooltip" title="Ver Detalles"><i class="fa fa-eye"></i></a>
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