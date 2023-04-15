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

@section('title', 'Agregar notificación ')

@section('content_header')
   
@stop

@section('content')
<div class="card">
                <div class="card-header">{{ __('Asignar notificación a buzon electrónico') }}</div>

                    <div class="card-body">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert" >
                            {{ session('status')}}
                        </div>
                     @endif
                    <form method="POST" action="{{route('store_addnot',$notificacion->id) }}">
                        @csrf

                        <div class="form-group ">
                            <label for="ap" >{{ __('Notificacion No.') }}</label>

                            <div class="">
                                <input id="notificaciones_id" type="text" class="form-control @error('notificaciones_id') is-invalid @enderror" 
                                name="notificaciones_id" value="{{ old('ap', $notificacion->id) }}" required autocomplete="notificaciones_id" required>

                                @error('notificacion_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>      
                        <div class="form-group ">
                            <label for="folio" >{{ __('Expediente') }}</label>

                            <div class="">
                                <input id="folio" type="text" class="form-control @error('folio') is-invalid @enderror" 
                                name="folio" value="{{ old('folio', $notificacion->asigna_actuaciones->expedientes->folio) }}" required autocomplete="folio" required>

                                @error('folio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>      

                        <div class="form-group ">
                            <label for="magistrado_nombre" >{{ __('Magistrado Instructor') }}</label>

                            <div class="">
                                <input id="magistrado_nombre" type="text" class="form-control @error('magistrado_nombre') is-invalid @enderror" name="magistrado_nombre" 
                                value="{{ old('magistrado_nombre', $notificacion->asigna_actuaciones->expedientes->ponencias->magistrados->nombre.' '.$notificacion->asigna_actuaciones->expedientes->ponencias->magistrados->primerapellido.' '.  
                                $notificacion->asigna_actuaciones->expedientes->ponencias->magistrados->segundoapellido) }}" required autocomplete="magistrado_nombre" required>

                                @error('magistrado_nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group ">
                            <label for="users_id" >{{ __('Responsable creación Notificación') }}</label>

                            <div class="">
                                <input id="users_id" type="text" class="form-control @error('users_id') is-invalid @enderror" name="users_id" value="{{ old('users_id',$notificacion->asigna_actuaciones->user->name) }}" required autocomplete="users_id" required>

                                @error('users_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                 


                         <div class="form-group ">
                            <label for="am" >{{ __('Actor :') }}</label>

                            <div class="">
                                <input id="curp" type="text" class="form-control @error('curp') is-invalid @enderror" name="curp" 
                                value="{{ old('curp', $notificacion->asigna_actuaciones->expedientes->actor) }}" required autocomplete="curp" required>

                                @error('curp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                 



                        <div class="form-group ">
                            <label for="am" >{{ __('Correo electrónico:') }}</label>

                            <div class="">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $notificacion->asigna_actuaciones->expedientes->email_actor) }}" required autocomplete="email" required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="juicio" >{{ __('Buzón Destinatario:') }}</label>

                            <div class="">
                                  <select name="buzones_id" id="buzones_id" required>
                                  <option value="">--Seleccione una opción--</option> 
                                    @foreach ($rsb as $buzones) 
                                      <option value="{{ $buzones->id }}">{{ $buzones->descripcion }}</option>
                                     @endforeach
                                </select> 
                                @error('juicios_id')
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

@endsection
