<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Ant',
 nextText: 'Sig >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'yy-mm-dd',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#fecha").datepicker();
});
</script>

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

@section('title', 'Agregar Expedinete ')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-folder-plus"> Crear expedientes</i> </h1></font>
@stop

@section('content')

            <div class="card">
                <div class="card-header dark">{{ __('Nuevo ') }}</div>

                    <div class="card-body">               
                   
                    @if (session('status'))                
                         @if (session('type'))
                                <script>
                                Swal.fire(
                                            "{{session('status')}}",
                                            'Presione Ok, para continuar',
                                            "{{session('type')}}"
                                            )
                                </script>                   
                                        <!--<div class="{{session('type')}}" role="alert">
                                            {{ session('status')}}
                                        </div>-->

                          @endif
                     @endif
                    <form method="POST" action="{{route('store_expediente') }}">
                        @csrf
                       <span >
                        <div class="form-group ">
                            <label for="ponencia_id" >{{ __('Ponencia:') }}</label>

                            <div class="">
                                  <select name="magistrados_id" id="magistrados_id" class="form-control" >
                                  <option>--Seleccione una ponencia--</option>  
                                  @foreach ($rsm as $magistrados) 
                                      <option  value="{{ $magistrados->id }}">{{ $magistrados->nombre }}  {{ $magistrados->primerapellido }}  {{ $magistrados->segundoapellido }}</option>
                                     @endforeach
                                </select> 
                            </div>
                                @error('ponencias_id')
                                    <span class="invalid-tooltip" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                         <div class="form-group ">
                            <label for="juicio" >{{ __('Juicio:') }}</label>

                            <div class="">
                                   
                            <select name="juicios_id" id="juicios_id" class="form-control">   
                            <option>--Seleccione un tipo de juicio--</option>      
                            @foreach ($rsj as $juicio) 
                                      <option value="{{ $juicio->id }}">{{ $juicio->descripcion }}</option>
                                     @endforeach
                                </select> 
                                @error('juicios_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </span>
                        <div class="form-group ">
                            <label for="interposicion" >{{ __('Forma de interposición:') }}</label>

                            <div class="">
                                  <select name="interposicion_id" id="interposicion_id" class="form-control">
                                  <option>--Seleccione un tipo de interposición--</option> 
                                    @foreach ($rsi as $interposicion) 
                                      <option value="{{ $interposicion->id }}">{{ $interposicion->descripcion }}</option>
                                     @endforeach
                                </select> 
                                @error('interposicion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="actor" >{{ __('Actor/Denunciante') }}</label>

                            <div class="form-group ">
                                <input id="actor" placeholder="Ej: José Luis Ramírez Ortiz" class="form-control @error('actor') is-invalid @enderror" type="text"  name="actor" value="{{ old('actor') }}" required autocomplete="actor" >

                                @error('actor')
                                    <span class="invalid-tooltip" >
                                        <strong>{{ "$message" }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="email_actor" >{{ __('Correo electrónico del actor') }}</label>

                            <div class="">
                                <input id="email_actor" placeholder="Ej: jlramez@gmail.com" type="text" class="form-control @error('email_actor') is-invalid @enderror" name="email_actor" value="{{ old('email_actor') }}" required autocomplete="email_actor">

                                @error('email_actor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="denunciado" >{{ __('Autoridad Responsable/Denunciado') }}</label>

                            <div class="">
                                <input id="denunciado" placeholder="Ej: Instituto Estatal Electoral (IEEZ)" type="text" class="form-control @error('denunciado') is-invalid @enderror" name="denunciado" value="{{ old('denunciado') }}" required autocomplete="denunciado">

                                @error('denunciado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

  
                        <div class="form-group ">
                            <label for="accion" >{{ __('Acto Impugnado/Acción') }}</label>

                            <div class="">
                                <input type="text" id="accion" placeholder="Ej: Violencia de género en materia electoral" type="textarea" class="form-control @error('accion') is-invalid @enderror" name="accion" value="{{ old('accion') }}" required autocomplete="accion"></textarea>

                                @error('accion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="terceros" >{{ __('Terceros Interesados') }}</label>

                            <div class="">
                                <input id="terceros" placeholder="Ej: José Luis Ramírez Ortiz" type="text" class="form-control @error('terceros') is-invalid @enderror" name="terceros" value="{{ old('terceros') }}" required>

                                @error('terceros')
                                    <span class="valid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="sexo" >{{ __('Sexo:') }}</label>

                            <div class="">
                                  <select name="sexo" id="sexo" class="form-control">
                                    
                                      <option value="0">Mujer</option>
                                      <option value="1">Hombre</option>
                                      <option value="2">Institución</option>
                                      <option value="3">Partido Político</option>
                                
                                </select> 
                                @error('sexo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="fecha" id="fecha" placeholder="Ej: 2021-10-03"> 
                            </div>
                        </div>
                        <script>
                            $('.datepicker').datepicker({
                                format: "yyyy-mm-dd",
                                language: "en",
                                autoclose: true
                            });
                        </script>
                        <div class="form-group">
                            <label for="hora">Hora</label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="hora" id="hora" placeholder="Ej: 10:30">
                            </div>
                        </div>                  
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                <i class="fas fa-save"></i>  {{ __('Guardar ') }}</a> 
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer" align="right"> 
                      <a href="{{ route( 'admin_expediente')}}"" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a> 
            </div>
        </div>
  
@endsection

@section('js')

  

@stop
