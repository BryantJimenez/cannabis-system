@extends('layouts.auth')

@section('title', 'Registro de Usuario')

@section('links')
<link href="{{ asset('/admins/vendor/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/admins/vendor/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')

<div class="form-container outer bg-primary">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content my-5">

                    <h1 class="">Registro de Usuario</h1>

                    <form class="text-left" action="{{ route('register') }}" method="POST" id="formRegister">
                        {{ csrf_field() }}

                        @include('admin.partials.errors')
                        
                        <div class="form">
                            <div class="field-wrapper input">
                                <label for="username">NOMBRE</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <input id="username" name="name" type="text" class="form-control @error('name') is-invalid @enderror" required placeholder="Carlos" value="{{ old('name') }}" minlength="2" maxlength="191">
                            </div>

                            <div class="field-wrapper input">
                                <label for="lastname">APELLIDO</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <input id="lastname" name="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" required placeholder="García" value="{{ old('lastname') }}" minlength="2" maxlength="191">
                            </div>

                            <div class="field-wrapper input">
                                <label for="birthday">FECHA DE NACIMIENTO</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                <input id="birthday" name="birthday" type="text" class="form-control date @error('birthday') is-invalid @enderror" required placeholder="01-01-1979" value="{{ old('birthday') }}">
                            </div>

                            <div class="field-wrapper input">
                                <label for="license">LICENCIA OCUPACIONAL</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                <input id="license" name="license" type="text" class="form-control @error('license') is-invalid @enderror" required placeholder="CM-0000-000" value="{{ old('license') }}">
                            </div>

                            <div id="username-field" class="field-wrapper input">
                                <label for="email">CORREO</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" required placeholder="{{ 'correo@gmail.com' }}" value="{{ old('email') }}" minlength="5" maxlength="191">
                            </div>

                            <div id="password-field" class="field-wrapper input mb-2">
                                <label for="password">CONTRASEÑA</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required placeholder="********" minlength="8" maxlength="40">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </div>

                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary font-weight-bold" action="register">Registrate</button>
                                </div>
                            </div>

                            <div class="d-sm-flex justify-content-center mt-3">
                                <div class="field-wrapper">
                                    <p class="text-center">Deseas ingresar? <a href="{{ route('login') }}" class="text-primary m-l-5"><b>Ingresa</b></a></p>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>                    
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/es.js') }}"></script>
<script src="{{ asset('/admins/vendor/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('/auth/js/script.js') }}"></script>
@endsection