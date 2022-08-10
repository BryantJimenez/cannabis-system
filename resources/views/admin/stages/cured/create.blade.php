@extends('layouts.admin')

@section('title', 'Etapa de Curado')

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
						<h4>Etapa de Curado</h4>
					</div>                 
				</div>
			</div>
			<div class="widget-content widget-content-area">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('stages.cured.store') }}" method="POST" class="form" id="formStageCured">
							@csrf
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Cepa<b class="text-danger">*</b></label>
									<select class="form-control" name="strain_id" required>
										<option value="">Seleccione</option>
										@foreach($strains as $strain)
										<option value="{{ $strain->slug }}" @if(old('strain_id')==$strain->slug) selected @endif>{{ $strain->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Cuarto<b class="text-danger">*</b></label>
									<select class="form-control" name="room_id" required>
										<option value="">Seleccione</option>
										@foreach($rooms as $room)
										<option value="{{ $room->slug }}" @if(old('room_id')==$room->slug) selected @endif>{{ $room->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Cosecha<b class="text-danger">*</b></label>
									<select class="form-control" name="harvest_id" required>
										<option value="">Seleccione</option>
										@foreach($harvests as $harvest)
										<option value="{{ $harvest->slug }}" @if(old('harvest_id')==$harvest->slug) selected @endif>{{ $harvest->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Recipiente<b class="text-danger">*</b></label>
									<select class="form-control" name="container_id" required id="selectContainers">
										<option value="">Seleccione</option>
										@foreach($containers as $container)
										<option value="{{ $container->slug }}" use="{{ $container->use }}" @if(old('container_id')==$container->slug) selected @endif>{{ $container->name.' (Uso: '.$container->use.'/'.$setting->qty_plants.')' }}</option>
										@endforeach
									</select>
								</div>

								<div class="col-12">
									<h6 class="font-weight-bold">Plantas</h6>
								</div>

								@for($i=0; $i<$setting->qty_plants; $i++)
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Planta {{ $i+1 }}@if($i==0)<b class="text-danger">*</b>@else{{ ' (Opcional)' }}@endif</label>
									<input class="form-control @error('plants.'.$i) is-invalid @enderror" type="text" @if($i==0) name="plants[{{ $i }}]" required @else name="plants[]" @endif placeholder="Introduzca el código de la planta" value="{{ old('plants.'.$i) }}" id="{{ 'plants_'.$i }}">
								</div>
								@endfor

								<div class="col-12">
									<p class="duplicate-error text-danger font-weight-bold d-none">Escribiste códigos duplicados.</p>
									<p class="plants_error text-danger font-weight-bold d-none">Este recipiente tiene más plantas de las recomendadas.</p>
								</div>

								<div class="col-12">
									<h6 class="font-weight-bold">Pesos</h6>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Flores<b class="text-danger">*</b></label>
									<input class="form-control min-decimal-grams @error('flower') is-invalid @enderror" type="text" name="flower" required placeholder="Introduzca el peso de la flor" value="{{ old('flower') }}" id="flower">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Flores Confirmación<b class="text-danger">*</b></label>
									<input class="form-control min-decimal-grams @error('flower_confirmation') is-invalid @enderror" type="text" name="flower_confirmation" required placeholder="Introduzca la confirmación del peso de la flor" value="{{ old('flower_confirmation') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Desperdicios<b class="text-danger">*</b></label>
									<input class="form-control min-decimal-grams @error('waste') is-invalid @enderror" type="text" name="waste" required placeholder="Introduzca el peso de los desperdicios" value="{{ old('waste') }}" id="waste">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Desperdicios Confirmación<b class="text-danger">*</b></label>
									<input class="form-control min-decimal-grams @error('waste_confirmation') is-invalid @enderror" type="text" name="waste_confirmation" required placeholder="Introduzca la confirmación del peso de los desperdicios" value="{{ old('waste_confirmation') }}">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Notas (Opcional)</label>
									<textarea class="form-control @error('note') is-invalid @enderror" name="note" placeholder="Introduzca una nota">{{ old('note') }}</textarea>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="stage">Guardar</button>
										<a href="{{ route('stages.cured.index') }}" class="btn btn-secondary">Volver</a>
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