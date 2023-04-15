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
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Generar Notifiacación Electrónica del expediente '. $aact[0]->folio) }}</div>
                    <div class="card-body">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                     @endif
                <div class="card-body">
                    <form method="POST" action="{{url('notificacion/'.$aact[0]->id_aact) }}">
                  

                        @csrf

                        <div class="form-group ">
                            <label for="folio">{{ __('Expediente') }}</label>
                            <div class="">
                                <input id="folio" type="text" class="form-control @error('folio') is-invalid @enderror"
                                 name="folio" value="{{ old('folio', $aact[0]->folio) }}" required autocomplete="folio" autofocus>
                                 <input name="asigna_act_id"  id="asigna_act_id" type="text" value="{{$aact[0]->id_aact}}" >

                                @error('folio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="actuacion">{{ __('Actuación') }}</label>
                            <div class="">
                                <input id="actuacion" type="text" class="form-control @error('actuacion') is-invalid @enderror"
                                 name="actuacion" value="{{ old('actuacion', $aact[0]->nombre_act) }}" required autocomplete="actuacion" autofocus >

                                @error('Nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="resumen">{{ __('Resumen') }}</label>
                            <div class="">
                                <input id="resumen" type="text" class="form-control @error('resumen') is-invalid @enderror"
                                 name="resumen" value="{{ old('resumen', $aact[0]->resumen_act) }}" required autocomplete="resumen" autofocus>

                                @error('resumen')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <label for="magistrado">{{ __('Magistrado Instructor') }}</label>
                            <div class="">
                                <input id="magistrado" type="text" class="form-control @error('magistrado') is-invalid @enderror"
                                 name="magistrado" value="{{ old('magistrado', $aact[0]->nombre_magistrado.' '.$aact[0]->ap_magistrado.' '.$aact[0]->am_magistrado )}}" required autocomplete="magistrado" autofocus>

                                @error('magistrado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="email_actor">{{ __('Correo electrónico Actor') }}</label>
                            <div class="">
                                <input id="email_actor" type="text" class="form-control @error('email_actor') is-invalid @enderror"
                                 name="email_actor" value="{{ old('email_actor', $aact[0]->email )}}" required autocomplete="email_actor" autofocus>

                                @error('email_actor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="fecha" id="fecha" class="form-control @error('email_actor') is-invalid @enderror">
                            </div>
                        </div>
                      
                        @error('fecha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                  
                                    
                        <script>
                            $('.datepicker').datepicker({
                                format: "yyyy-mm-dd",
                                language: "en",
                                autoclose: true
                            });
                        </script>
                                    
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i>
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer" align="right"> 
                      <!--<a href="{{ url( 'expedientes/admin')}}"" class="btn btn-danger" ><i class="fas fa-file-pdf"></i>Adjuntar </a>   
                      <a href="{{ url( 'expedientes/admin')}}"" class="btn btn-primary" ><i class="fas fa-file-word"></i>Adjuntar </a> --> 
                      <a href="{{ url( 'asigna_actuaciones/'.$aact[0]->expediente_id.'/show')}}"" class="btn btn-success" ><i class="fas fa-check-circle"></i>Aceptar</a>        
            </div>
        </div>
    </div>
</div>
@endsection