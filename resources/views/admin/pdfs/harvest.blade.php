<!DOCTYPE html>
<html>
<head>
	<title>Cosecha</title>
	<link href="{{ public_path('/admins/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
	<style>
		@page {
			margin: 100px 50px 80px;
		}

		#header { 
			position: fixed;
			left: 0px;
			top: -50px;
			right: 0px;
			height: 30px;
		}

		#footer {
			position: fixed;
			left: 0px;
			bottom: 0px;
			right: 0px;
			height: 30px;
			text-align: center;
		}

		#footer .page:after {
			content: counter(page, numeric);
		}

		body, h1, h2, h3, h4, h5, h6, p {
			font-family: Helvetica !important;
		}

		.text-black {
			color: #000000;
		}

		.table-data th {
			color: #000000;
			background-color: #98d8ff;
		}

		.table td, .table th {
			padding-top: 1px !important;
			padding-bottom: 1px !important;
			border: 1px solid #000000!important;
		}
	</style>

	<div id="header">
		<div class="w-100">
			<h3 class="text-center text-uppercase">Cosecha: {{ $harvest->name }}</h3>
		</div>
	</div>

	<div id="footer">
		<div class="w-100 mt-2">
			<p class="page">Página </p>
		</div>
	</div>

	<div id="content mt-2">
		<div class="w-100 mt-2">
			<table class="table table-bordered table-data">
				<thead>
					<tr>
						<th class="font-weight-bold small">Cosecha</th>
						<th class="font-weight-bold small">Recipiente</th>
						<th class="font-weight-bold small">Código de Planta</th>
					</tr>
				</thead>
				<tbody class="border-bottom">
					@if(!is_null($stages) && $stages->count()>0)
					@foreach($stages as $stage)
					@foreach($stage['plants'] as $plant)
					<tr>
						@if($loop->first)
						<td rowspan="{{ $stage->plants_count }}" class="text-black small">{{ $stage['strain']->name }}</td>
						<td rowspan="{{ $stage->plants_count }}" class="text-black small">{{ $stage['container']->name }}</td>
						@endif
						<td class="text-black small">{{ $plant->code }}</td>
					</tr>
					@endforeach
					@endforeach
					@else
					<tr>
						<td colspan="3">No hay resultados</td>
					</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>