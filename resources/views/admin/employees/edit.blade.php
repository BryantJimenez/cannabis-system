@extends('layouts.admin')

@section('title', 'Editar Trabajador')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/dropify/dropify.min.css') }}">
<link href="{{ asset('/admins/vendor/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/admins/vendor/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
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
						<h4>Editar Trabajador</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('employees.update', ['employee' => $employee->slug]) }}" method="POST" class="form" id="formEmployee" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Foto (Opcional)</label>
									<input type="file" name="photo" accept="image/*" class="dropify custom-error" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" data-default-file="{{ $employee->photo_url }}" />
									<div class="custom-error-photo"></div>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<div class="row">
										<div class="form-group col-12">
											<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
											<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Introduzca un nombre" value="{{ old('name', $employee->name) }}">
										</div>

										<div class="form-group col-12">
											<label class="col-form-label">Apellido<b class="text-danger">*</b></label>
											<input class="form-control @error('lastname') is-invalid @enderror" type="text" name="lastname" required placeholder="Introduzca un apellido" value="{{ old('lastname', $employee->lastname) }}">
										</div>
									</div>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Teléfono<b class="text-danger">*</b></label>
									<input class="form-control number @error('phone') is-invalid @enderror" type="text" name="phone" required placeholder="Introduzca un teléfono" value="{{ old('phone', $employee->phone) }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Fecha de Nacimiento<b class="text-danger">*</b></label>
									<input class="form-control date @error('birthday') is-invalid @enderror" type="text" name="birthday" required placeholder="Seleccione una fecha de nacimiento" value="{{ old('birthday', $employee->birthday->format('d-m-Y')) }}" id="flatpickr">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Licencia Ocupacional<b class="text-danger">*</b></label>
									<input class="form-control @error('license') is-invalid @enderror" type="text" name="license" required placeholder="Introduzca una licencia ocupacional" value="{{ old('license', $employee->license) }}" id="maskLicense">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Correo Electrónico</label>
									<input class="form-control text-dark" type="text" disabled value="{{ $employee->email }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Tipo<b class="text-danger">*</b></label>
									<select class="form-control @error('type') is-invalid @enderror" name="type" required>
										<option value="">Seleccione</option>
										@foreach($roles as $role)
										<option @if(old('type')==$role || (is_null(old('type')) && $employee->hasRole($role))) selected @endif>{{ $role }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Estado<b class="text-danger">*</b></label>
									<select class="form-control @error('state') is-invalid @enderror" name="state" required>
										<option value="1" @if(old('state', $employee->state)=="Activo" || old('state', $employee->state)=="1") selected @endif>Activo</option>
										<option value="0" @if(old('state', $employee->state)=="Inactivo" || old('state', $employee->state)=="0") selected @endif>Inactivo</option>
									</select>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary mr-0" action="employee">Actualizar</button>
										<a href="{{ route('employees.index') }}" class="btn btn-secondary mr-0">Volver</a>
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

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/dropify/dropify.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/es.js') }}"></script>
<script src="{{ asset('/admins/vendor/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection