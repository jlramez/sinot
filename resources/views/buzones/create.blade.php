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

@section('title', 'Agregar Buzones ')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-mail-bulk"> Crear buzón para el  Sistema de  Notificación Electrónica </i></h1></font>
@stop

@section('content')

            <div class="card">
                <div class="card-header">{{ __('Nuevo ') }}</div>

                    <div class="card-body">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert" >
                            {{ session('status')}}
                        </div>
                     @endif
                    <form method="POST" action="{{route('store_buzon') }}">
                        @csrf

                        <div class="form-group " columnsize="md">
                            <label for="descripcion">{{ __('Descripción') }}</label>
                            <div class="">
                                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}" required autocomplete="descripcion" autofocus>

                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group ">
                            <label for="usuario_id" >{{ __('Usuario:') }}</label>

                            <div class="">
                                  <select name="usuario_id" id="usuario_id" class="form-control">
                                      <option value="">--Seleccione una opción--</option> 
                                    @foreach ($rs_user as $usuario) 
                                      <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
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
                            <label for="activo" >{{ __('Activo:') }}</label>

                            <div class="col-md-6">
                                  <select name="activo" id="activo" class="form-control">
                                    
                                      <option value="0">No</option>
                                      <option value="1">Si</option>
                                                                   
                                </select> 
                                @error('activo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Guardar ') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer" align="right"> 
                      <a href="{{ url( 'buzon/admin')}}"" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a> 
        </div>
   
    @endsection