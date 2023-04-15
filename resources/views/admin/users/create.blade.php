@extends('adminlte::page')
@section('title', 'Registrar Usuarios TRIJEZ')

@section('content_header')
    <h1>Registro de usuarios</h1>
@stop
@section('content')

            <div class="card">
                <div class="card-header">
                
                </div>

                <div class="card-body">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                     @endif
                    <form method="POST" action="{{ route('store_usuario') }}">
                        @csrf
                                                                    
                                               
                            <div class="form-group ">
                                <label for="name" >{{ __('Usuario') }}</label>

                                <div >
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="ejemplo: lramirez" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                    

                        <div class="form-group ">
                            <label for="email" >{{ __('Correo electrónico') }}</label>

                            <div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group" >
                            <label for="password" >{{ __('Contraseña') }}</label>

                            <div >
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="password-confirm" >{{ __('Confirmar Contraseña') }}</label>

                            <div >
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="rol" >{{ __('Empleado') }}</label>

                            <div > 
                                <select name="empleado_id" id="empleado_id">
                                    @foreach ($rse as $empleado) 
                                      <option value="{{ $empleado->id }}">{{ $empleado->nombre }} {{ $empleado->ap }} {{ $empleado->am }}</option>
                                     @endforeach
                                </select> 
                                
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="rol" >{{ __('Rol de Usuario') }}</label>

                            <div > 
                                <select name="rol_id" id="rol_id">
                                    @foreach ($rsr as $rol) 
                                      <option value="{{ $rol->id }}">{{ $rol->descripcion }}</option>
                                     @endforeach
                                </select> 
                            </div>
                        </div>               

                        <div class="form-group ">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer" align="right"> 
                      <a href="{{ url( 'usuarios/admin')}}"" class="btn btn-success" ><i class="fas fa-check-circle"></i>Aceptar</a> 
            </div>
        </div>
    <>
@endsection
