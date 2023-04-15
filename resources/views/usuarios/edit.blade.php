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

@section('title', 'Editar usuarios')

@section('content_header')
   
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Usuario') }}</div>

                    <div class="card-body">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                     @endif
                    <form method="POST" action="{{route('update_usuario',$user->id) }}">
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
                        
                        
                        <div class="form-group">
                            <label for="password" >{{ __('Password') }}</label>

                            <div class="col-md-6">
                          
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"  required autocomplete="new-password">
                           
                          
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group" >
                            <label for="password-confirm" >{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                          
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" required autocomplete="new-password">
                           
                           
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
                            <label for="empleados_id" >{{ __('Id: Empleado') }}</label>

                            <div class="">
                                <input id="empleados_id" type="text" class="form-control @error('empleados_id') is-invalid @enderror" name="empleados_id" value="{{ old('empleados_id', $user->empleados_id) }}" required autocomplete="empleados_id" disabled>

                                @error('empleados_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Guardar Cambios') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer" align="right"> 
                      <a href="{{ url( 'usuarios/admin')}}"" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a> 
            </div>
        </div>
    </div>
</div>
@endsection
