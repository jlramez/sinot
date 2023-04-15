<style>
      textarea:focus, input:focus, input[type]:focus 
      {
            border-color: rgb(54, 112, 104);
            box-shadow: 0 1px 1px rgba(54, 112, 104, 0.075)inset, 0 0 8px rgba(54, 112, 104,0.6);
            outline: 0 none;

       }
    
       option:hover {
         background:green
        }
       

  </style>
@extends('adminlte::page')

@section('title', 'Agregar Usuarios TRIJEZ')

@section('content_header')
 
@stop

@section('content')

            <div class="card">
                <div class="card-header">{{ __('Registrar Usuarios TRIJEZ') }}</div>

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

                                <div class="col-md-6">
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

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="password" ">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="rol" >{{ __('Empleado') }}</label>

                            <div class="col-md-6"> 
                                <select name="empleado_id" id="empleado_id" class="form-control">
                                    @foreach ($rse as $empleado) 
                                      <option value="{{ $empleado->id }}">{{ $empleado->nombre }} {{ $empleado->ap }} {{ $empleado->am }}</option>
                                     @endforeach
                                </select> 
                                
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="rol" >{{ __('Rol de Usuario ') }}</label>

                            <div class="col-md-6"> 
                                <select name="rol_id" id="rol_id" class="form-control">
                                    @foreach ($rsr as $rol) 
                                      <option value="{{ $rol->id }}">{{ $rol->descripcion }}</option>
                                     @endforeach
                                </select> 
                            </div>
                        </div>               

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer" align="right"> 
                      <a href="{{ url( 'usuarios/admin')}}"" class="btn btn-dark" ><i class="fas fa-check-circle"></i>Aceptar</a> 
            </div>
        </div>
  
@endsection
