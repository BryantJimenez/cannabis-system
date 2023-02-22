@extends('layouts.admin')

@section('title', 'Estadísticas')

@section('links')
<link href="{{ asset('/admins/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('/admins/vendor/bootstrap-select/bootstrap-select.min.css') }}">
<link href="{{ asset('/admins/vendor/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/admins/vendor/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/custom_dt_html5.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">
	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-12">
						<h4>Estadísticas</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12 mt-3">
						<form action="{{ route('statistics.index') }}" method="GET" class="form" id="formSearchStatistic">
							<div class="row">
								<div class="col-12">
									@include('admin.partials.errors')
								</div>

								<div class="form-group col-lg-4 col-md-4 col-12">
									<label class="col-form-label">Cosechas<b class="text-danger">*</b></label>
									<select class="form-control selectpicker custom-error" name="harvest_id" required data-size="10" data-live-search="true" title="Seleccione">
										@foreach($harvests as $harvesting)
										<option value="{{ $harvesting->slug }}" @if(request('harvest_id')==$harvesting->slug) selected @endif>{{ $harvesting->name }}</option>
										@endforeach
									</select>
									<div class="custom-error-harvest_id"></div>
								</div>

								<div class="form-group col-lg-4 col-md-4 col-12">
									<label class="col-form-label">Fecha (Mínima) (Opcional)</label>
									<input class="form-control" type="text" name="start" placeholder="Seleccione" value="{{ request('start') }}" id="startDateSearchFlatpickr">
								</div>

								<div class="form-group col-lg-4 col-md-4 col-12">
									<label class="col-form-label">Fecha (Máxima) (Opcional)</label>
									<input class="form-control" type="text" name="end" placeholder="Seleccione" value="{{ request('end') }}" id="endDateSearchFlatpickr">
								</div>

								<div class="form-group text-right col-12">
									<div class="btn-group" role="group">
										<button type="button" class="btn btn-secondary mr-0" id="btnSearchClear">Limpiar</button>
										<button type="submit" class="btn btn-primary mr-0" action="search">Buscar</button>
									</div>
								</div> 
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@if(!is_null(request('harvest_id')) && !is_null($harvest) && !is_null($strains))
<div class="row">
	<div class="col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">Cosecha {{ $harvest->name }} - Etapa de Curado: Desempeño por Trabajador</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<div class="row">
									<div class="col-12">
										<div class="table-responsive">
											<table class="table table-normal table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>Trabajador</th>
														<th>Días<br>Trabajados</th>
														<th>Total de<br>Plantas</th>
														<th>Total de<br>Compartimentos</th>
														<th>Peso Final<br>de Flor</th>
														<th>Peso Final<br>de Desperdicios</th>
													</tr>
												</thead>
												<tbody>
													@foreach($employees as $employee)
													<tr>
														<td>{{ $loop->iteration }}</td>
														<td>{{ $employee->fullname }}</td>
														<td>
															{{ $employee['stages']->where('type', 'Curado')->map(function ($stage) {
																$stage->date=$stage->created_at->format('Y-m-d');
																return collect($stage)->only("date");
															})->unique()->values()->count() }}
														</td>
														<td>{{ number_format($employee['stages']->where('type', 'Curado')->values()->sum('plants_count'), 0, ',', '.').'/'.number_format($harvest['stages']->where('type', 'Curado')->values()->sum('plants_count'), 0, ',', '.') }}</td>
														<td>{{ number_format($employee['stages']->where('type', 'Curado')->values()->count(), 0, ',', '.').'/'.number_format($harvest['stages']->where('type', 'Curado')->values()->count(), 0, ',', '.') }}</td>
														<td>{{ number_format($employee['stages']->where('type', 'Curado')->values()->sum('flower'), 2, ',', '.').'g' }}</td>
														<td>{{ number_format($employee['stages']->where('type', 'Curado')->values()->sum('waste'), 2, ',', '.').'g' }}</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
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
					<h3 class="pb-3">Cosecha {{ $harvest->name }} - Etapa de Curado: Estadísticas del Departamento</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<div class="row">
									<div class="col-12">
										<div class="text-right">
											<a target="_blank" href="{{ route('statistics.harvests.pdf', ['slug' => $harvest->slug]) }}" class="btn btn-primary">PDF</a>
										</div>

										<div class="table-responsive mt-4">
											<table class="table table-normal table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>Cepa</th>
														<th>Total de<br>Plantas</th>
														<th>Total de<br>Compartimentos</th>
														<th>Peso Final<br>de Flor</th>
														<th>Peso Final<br>de Desperdicios</th>
													</tr>
												</thead>
												<tbody>
													@foreach($strains as $strain)
													<tr>
														<td>{{ $loop->iteration }}</td>
														<td>{{ $strain->name }}</td>
														<td>{{ number_format($strain['stages']->where('type', 'Curado')->values()->sum('plants_count'), 0, ',', '.') }}</td>
														<td>{{ number_format($strain['stages']->where('type', 'Curado')->values()->count(), 0, ',', '.') }}</td>
														<td>{{ number_format($strain['stages']->where('type', 'Curado')->values()->sum('flower'), 2, ',', '.').'g' }}</td>
														<td>{{ number_format($strain['stages']->where('type', 'Curado')->values()->sum('waste'), 2, ',', '.').'g' }}</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
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
					<h3 class="pb-3">Cosecha {{ $harvest->name }} - Etapa de Trimmiado: Desempeño por Trabajador</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<div class="row">
									<div class="col-12">
										<div class="table-responsive">
											<table class="table table-normal table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>Trabajador</th>
														<th>Días<br>Trabajados</th>
														<th>Total de<br>Plantas</th>
														<th>Total de<br>Compartimentos</th>
														<th>Peso Final<br>de Flor</th>
														<th>Peso Final<br>de Larf</th>
														<th>Peso Final<br>de Trim</th>
														<th>Peso Final<br>de Desperdicios</th>
													</tr>
												</thead>
												<tbody>
													@foreach($employees as $employee)
													<tr>
														<td>{{ $loop->iteration }}</td>
														<td>{{ $employee->fullname }}</td>
														<td>
															{{ $employee['stages']->where('type', 'Trimmiado')->map(function ($stage) {
																$stage->date=$stage->created_at->format('Y-m-d');
																return collect($stage)->only("date");
															})->unique()->values()->count() }}
														</td>
														<td>{{ number_format($employee['stages']->where('type', 'Trimmiado')->values()->sum('plants_count'), 0, ',', '.').'/'.number_format($harvest['stages']->where('type', 'Trimmiado')->values()->sum('plants_count'), 0, ',', '.') }}</td>
														<td>{{ number_format($employee['stages']->where('type', 'Trimmiado')->values()->count(), 0, ',', '.').'/'.number_format($harvest['stages']->where('type', 'Trimmiado')->values()->count(), 0, ',', '.') }}</td>
														<td>{{ number_format($employee['stages']->where('type', 'Trimmiado')->values()->sum('flower'), 2, ',', '.').'g' }}</td>
														<td>{{ number_format($employee['stages']->where('type', 'Trimmiado')->values()->sum('larf'), 2, ',', '.').'g' }}</td>
														<td>{{ number_format($employee['stages']->where('type', 'Trimmiado')->values()->sum('trim'), 2, ',', '.').'g' }}</td>
														<td>{{ number_format($employee['stages']->where('type', 'Trimmiado')->values()->sum('waste'), 2, ',', '.').'g' }}</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
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
					<h3 class="pb-3">Cosecha {{ $harvest->name }} - Etapa de Trimmiado: Estadísticas del Departamento</h3>
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
												<th>Cepa</th>
												<th>Total de<br>Compartimentos</th>
												<th>Peso Final<br>de Flor</th>
												<th>Peso Final<br>de Larf</th>
												<th>Peso Final<br>de Trim</th>
												<th>Peso Final<br>de Desperdicios</th>
												@if(!is_null(request('start')) && !is_null(request('end')))
												<th>Acciones</th>
												@endif
											</tr>
										</thead>
										<tbody>
											@foreach($strains as $strain)
											<tr>
												<td>{{ $loop->iteration }}</td>
												<td>{{ $strain->name }}</td>
												<td>{{ number_format($strain['stages']->where('type', 'Trimmiado')->values()->count(), 0, ',', '.') }}</td>
												<td>{{ number_format($strain['stages']->where('type', 'Trimmiado')->values()->sum('flower'), 2, ',', '.').'g' }}</td>
												<td>{{ number_format($strain['stages']->where('type', 'Trimmiado')->values()->sum('larf'), 2, ',', '.').'g' }}</td>
												<td>{{ number_format($strain['stages']->where('type', 'Trimmiado')->values()->sum('trim'), 2, ',', '.').'g' }}</td>
												<td>{{ number_format($strain['stages']->where('type', 'Trimmiado')->values()->sum('waste'), 2, ',', '.').'g' }}</td>
												@if(!is_null(request('start')) && !is_null(request('end')))
												<td>
													<div class="btn-group" role="group">
														<a href="{{ route('statistics.harvests.employees.flower.excel', ['harvest' => $harvest->slug, 'strain' => $strain->slug, 'start' => request('start'), 'end' => request('end')]) }}" class="btn btn-primary btn-sm bs-tooltip" title="Flor x Empleado"><i class="fa fa-file-excel"></i></a>
														<a href="{{ route('statistics.harvests.employees.larf.excel', ['harvest' => $harvest->slug, 'strain' => $strain->slug, 'start' => request('start'), 'end' => request('end')]) }}" class="btn btn-info btn-sm bs-tooltip" title="Larf x Empleado"><i class="fa fa-file-excel"></i></a>
													</div>
												</td>
												@endif
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
@endif

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/es.js') }}"></script>
<script src="{{ asset('/admins/vendor/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection