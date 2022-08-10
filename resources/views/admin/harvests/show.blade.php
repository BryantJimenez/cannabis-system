@extends('layouts.admin')

@section('title', 'Detalles de la Cosecha')

@section('links')
<link href="{{ asset('/admins/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/custom_dt_html5.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/dt-global_style.css') }}">
@endsection

@section('content')

<div class="row">
	<div class="col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">Cosecha {{ $harvest->name }}: Etapa de Curado</h3>
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
												<th>Total de<br>Plantas</th>
												<th>Total de<br>Recipientes</th>
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
					<h3 class="pb-3">Cosecha {{ $harvest->name }}: Etapa de Trimmiado</h3>
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
												<th>Total de<br>Recipientes</th>
												<th>Peso Final<br>de Flor</th>
												<th>Peso Final<br>de Larf</th>
												<th>Peso Final<br>de Trim</th>
												<th>Peso Final<br>de Desperdicios</th>
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