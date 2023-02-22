@extends('layouts.admin')

@section('title', 'Crear Etapa de Trimmiado')

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-xl-12 col-md-12 col-sm-12 col-12">
						<h4>Crear Etapa de Trimmiado</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('stages.trimmed.store') }}" method="POST" class="form" id="formStageTrimmed">
							@csrf
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Cepa<b class="text-danger">*</b></label>
									<select class="form-control" name="strain_id" required id="selectStrains">
										<option value="">Seleccione</option>
										@foreach($strains as $strain)
										<option value="{{ $strain->slug }}" @if(old('strain_id')==$strain->slug) selected @endif>{{ $strain->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Cuarto<b class="text-danger">*</b></label>
									<select class="form-control" name="room_id" required id="selectRooms">
										<option value="">Seleccione</option>
										@foreach($rooms as $room)
										<option value="{{ $room->slug }}" @if(old('room_id')==$room->slug) selected @endif>{{ $room->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Cosecha<b class="text-danger">*</b></label>
									<select class="form-control" name="harvest_id" required id="selectHarvests">
										<option value="">Seleccione</option>
										@foreach($harvests as $harvest)
										<option value="{{ $harvest->slug }}" @if(old('harvest_id')==$harvest->slug) selected @endif>{{ $harvest->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Compartimento<b class="text-danger">*</b></label>
									<select class="form-control" name="container_id" required id="selectContainers">
										<option value="">Seleccione</option>
									</select>
								</div>

								<div class="col-12">
									<h6 class="font-weight-bold">Pesos</h6>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Flores<b class="text-danger">*</b></label>
									<input class="form-control min-decimal-grams custom-error @error('flower') is-invalid @enderror" type="text" name="flower" required placeholder="Introduzca el peso de la flor" value="{{ old('flower') }}" id="flower">
									<div class="custom-error-flower"></div>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Flores Confirmación<b class="text-danger">*</b></label>
									<input class="form-control min-decimal-grams custom-error @error('flower_confirmation') is-invalid @enderror" type="text" name="flower_confirmation" required placeholder="Introduzca la confirmación del peso de la flor" value="{{ old('flower_confirmation') }}">
									<div class="custom-error-flower_confirmation"></div>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Larf<b class="text-danger">*</b></label>
									<input class="form-control min-decimal-grams custom-error @error('larf') is-invalid @enderror" type="text" name="larf" required placeholder="Introduzca el peso del larf" value="{{ old('larf') }}" id="larf">
									<div class="custom-error-larf"></div>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Larf Confirmación<b class="text-danger">*</b></label>
									<input class="form-control min-decimal-grams custom-error @error('larf_confirmation') is-invalid @enderror" type="text" name="larf_confirmation" required placeholder="Introduzca la confirmación del peso del larf" value="{{ old('larf_confirmation') }}">
									<div class="custom-error-larf_confirmation"></div>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Trim<b class="text-danger">*</b></label>
									<input class="form-control min-decimal-grams custom-error @error('trim') is-invalid @enderror" type="text" name="trim" required placeholder="Introduzca el peso del trim" value="{{ old('trim') }}" id="trim">
									<div class="custom-error-trim"></div>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Trim Confirmación<b class="text-danger">*</b></label>
									<input class="form-control min-decimal-grams custom-error @error('trim_confirmation') is-invalid @enderror" type="text" name="trim_confirmation" required placeholder="Introduzca la confirmación del peso del trim" value="{{ old('trim_confirmation') }}">
									<div class="custom-error-trim_confirmation"></div>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Desperdicios<b class="text-danger">*</b></label>
									<input class="form-control min-decimal-grams custom-error @error('waste') is-invalid @enderror" type="text" name="waste" required placeholder="Introduzca el peso de los desperdicios" value="{{ old('waste') }}" id="waste">
									<div class="custom-error-waste"></div>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Desperdicios Confirmación<b class="text-danger">*</b></label>
									<input class="form-control min-decimal-grams custom-error @error('waste_confirmation') is-invalid @enderror" type="text" name="waste_confirmation" required placeholder="Introduzca la confirmación del peso de los desperdicios" value="{{ old('waste_confirmation') }}">
									<div class="custom-error-waste_confirmation"></div>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Notas (Opcional)</label>
									<textarea class="form-control @error('note') is-invalid @enderror" name="note" placeholder="Introduzca una nota">{{ old('note') }}</textarea>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="stage">Guardar</button>
										<a href="{{ route('stages.trimmed.index') }}" class="btn btn-secondary">Volver</a>
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
<script src="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection