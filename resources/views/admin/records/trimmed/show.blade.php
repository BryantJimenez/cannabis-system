@extends('layouts.admin')

@section('title', 'Detalles del Trimmiado')

@section('links')
<link href="{{ asset('/admins/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="row">
	<div class="col-xl-4 col-lg-6 col-md-6 col-12 layout-top-spacing">
		<x-card-user user="{{ $stage['user']->slug }}" route="{{ route('employees.edit', ['employee' => $stage['user']->slug]) }}" permission="employees.edit" title="Datos del Trabajador"></x-card-user>
	</div>

	<div class="col-xl-8 col-lg-6 col-md-6 col-12 layout-top-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">Detalles del Trimmiado</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2">
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Fecha:</b> {{ $stage->created_at->format("d-m-Y") }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Cepa:</b> {{ $stage['strain']->name }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Cuarto:</b> {{ $stage['room']->name }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Cosecha:</b> {{ $stage['harvest']->name }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Compartimento:</b> {{ $stage['container']->name }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Plantas en el Compartimento:</b> {{ $stage->plants_count }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Flor:</b> {{ number_format($stage->flower, 2, ',', '.').'g' }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Larf:</b> {{ number_format($stage->larf, 2, ',', '.').'g' }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Trim:</b> {{ number_format($stage->trim, 2, ',', '.').'g' }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Desperdicios:</b> {{ number_format($stage->waste, 2, ',', '.').'g' }}</span>
							</li>
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Nota:</b> @if(!is_null($stage->note)){{ $stage->note }}@else{{ 'No Ingresado' }}@endif</span>
							</li>
							<li class="contacts-block__item">
								<a href="{{ route('records.trimmed.index') }}" class="btn btn-secondary">Volver</a>
							</li>
						</ul>
					</div>                                    
				</div>
			</div>
		</div>
	</div>
</div>

@endsection