@extends('adminlte::page')

@section('title', 'Administración Usuarios')

@section('content_header')
    <h1>Editar usuarios</h1>
@stop

@section('content')
<div class="card">
                <div class="card-header">{{ __('Editar Usuario') }}</div>

                    <div class="card-body">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                     @endif
                    <form method="POST" action="{{url('/users',$user->id) }}">
                     @method('put')
                        @csrf

                        <div class="form-group ">
                            <label for="name">{{ __('Nombre del Usuario') }}</label>
                            <div class="">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('nombre', $user->name) }}" required autocomplete="name" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="email" >{{ __('Correo Electrónico') }}</label>

                            <div class="">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                      


                        <div class="form-group ">
                            <label for="am" >{{ __('Rol de Usuario:') }}</label>

                            <div class="">
                                  <select name="roles_id" id="roles_id">
                                    @foreach ($rsr as $rol) 
                                      <option value="{{ $rol->id }}">{{ $rol->descripcion }}</option>
                                     @endforeach
                                </select> 
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group ">
                            <label for="empleados_id" >{{ __('Pasword') }}</label>

                            <div class="">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password', $user->password) }}" required autocomplete="empleados_id" >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Guardar Cambios') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer" align="right"> 
                      <a href="{{ url( '/users')}}"" class="btn btn-success" ><i class="fas fa-check-circle"></i>Aceptar</a> 
            </div>
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script>
Swal.fire(
  'The Internet?',
  'That thing is still around?',
  'question'
)
</script>
@stop