@extends('layouts.admin')

@section('title', 'Lista de Curados')

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
						<h4>Lista de Curados</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">
						@can('stages.cured.create')
						<div class="text-right">
							<a href="{{ route('stages.cured.create') }}" class="btn btn-sm btn-primary">Agregar</a>
						</div>
						@endcan

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
										<th>Plantas</th>
										<th>Fecha</th>
										@if(auth()->user()->can('stages.cured.show') || auth()->user()->can('stages.cured.delete'))
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
											<img src="{{ $stage['user']->photo_url }}" class="rounded-circle mr-2" width="45" height="45" alt="{{ $stage['user']->fullname }}" title="{{ $stage['user']->fullname }}"> {{ $stage['user']->fullname }}
										</td>
										@endif
										<td>{{ $stage['strain']->name }}</td>
										<td>{{ $stage['room']->name }}</td>
										<td>{{ $stage['harvest']->name }}</td>
										<td>{{ $stage['container']->name }}</td>
										<td>
											@foreach($stage['plants'] as $plant)
											{{ $plant->code }}@if(!$loop->last)<br>@endif
											@endforeach
										</td>
										<td>{{ $stage->created_at->format('d-m-Y') }}</td>
										@if(auth()->user()->can('stages.cured.show') || auth()->user()->can('stages.cured.delete'))
										<td>
											<div class="btn-group" role="group">
												@can('stages.cured.show')
												<a href="{{ route('stages.cured.show', ['stage' => $stage->id]) }}" class="btn btn-primary btn-sm bs-tooltip mr-0" title="Ver Detalles"><i class="fa fa-eye"></i></a>
												@endcan
												@can('stages.cured.delete')
												<button type="button" class="btn btn-danger btn-sm bs-tooltip mr-0" title="Eliminar" onclick="deleteStageCured('{{ $stage->id }}')"><i class="fa fa-trash"></i></button>
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

@can('stages.cured.delete')
<x-modal-form modal="deleteStageCured" size="modal-lg" form="formDeleteStageCured" method="DELETE" title="¿Estás seguro de que quieres eliminar este curado?" validate="stage" close="Cancelar" button="Eliminar">
	<div class="row">
		<div class="col-12">
			@include('admin.partials.errors')
			<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
		</div>

		<div class="form-group col-12">
			<label class="col-form-label">Nota<b class="text-danger">*</b></label>
			<textarea class="form-control @error('note') is-invalid @enderror" name="note" required placeholder="Introduzca una nota" rows="5">{{ old('note') }}</textarea>
		</div>
	</div>
</x-modal-form>
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
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection