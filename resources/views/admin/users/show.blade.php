@extends('layouts.admin')

@section('title', 'Perfil de Usuario')

@section('links')
<link href="{{ asset('/admins/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="row">
	<div class="col-xl-4 col-lg-6 col-md-6 col-12 layout-top-spacing">
		<x-card-user user="{{ $user->slug }}" route="{{ route('users.edit', ['user' => $user->slug]) }}" permission="users.edit" title="Datos Personales"></x-card-user>
	</div>
</div>

@endsection