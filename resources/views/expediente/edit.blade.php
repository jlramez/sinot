
   <!-- date time picker 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>-->

    
   <!-- date time picker -->
   <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <!-- Latest compiled and minified CSS -->
      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <!-- Jquery -->
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script> 
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- Datepicker Files -->
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-standalone.css')}}">
    <script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}"></script>
    <!-- Languaje -->
    <script src="{{asset('datePicker/locales/bootstrap-datepicker.es.min.js')}}"></script>
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

@section('title', 'Expedientes')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-folder">Editar expedientes del Sistema de  Notificación Electrónica del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1></font>
@stop

@section('content')

            <div class="card">
                <div class="card-header">{{ __('Editar : ') }}{{$expediente->folio}}</div>

                    <div class="card-body">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                     @endif
                    <form method="POST" action="{{url('expediente/'.$expediente->id) }}">
                    @method('put')
                    @csrf
                    <div class="form-group ">
                            <label for="ponencia_id" >{{ __('Ponencia:') }}</label>

                            <div class="">
                                  <select name="ponencias_id" id="ponencias_id" class="form-control">
                                    @foreach ($rsp as $ponencia) 
                                      <option value="{{ $ponencia->id }}">{{ $ponencia->descripcion }}</option>
                                     @endforeach
                                </select> 
                            </div>
                                @error('ponencias_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    <div class="form-group ">
                            <label for="folio" >{{ __('Expediente:') }}</label>

                            <div class="">
                                <input id="folio" type="text" class="form-control @error('folio') is-invalid @enderror" name="folio" value="{{ old('folio',$expediente->folio) }}" required autocomplete="folio">

                                @error('actor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group ">
                            <label for="juicio" >{{ __('Juicio:') }}</label>

                            <div class="">
                                  <select name="juicios_id" id="juicios_id" class="form-control">
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
                        <div class="form-group ">
                            <label for="interposicion" >{{ __('Forma de interposición:') }}</label>

                            <div class="">
                                  <select name="interposicion_id" id="interposicion_id" class="form-control">
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

                            <div class="">
                                <input id="actor" type="text" class="form-control @error('actor') is-invalid @enderror" name="actor" value="{{ old('actor',$expediente->actor) }}" required autocomplete="actor">

                                @error('actor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="denunciado" >{{ __('Autoridad Responsable/Denunciado') }}</label>

                            <div class="">
                                <input id="denunciado" type="text" class="form-control @error('denunciado') is-invalid @enderror" name="denunciado" value="{{ old('denunciado',$expediente->denunciado) }}" required autocomplete="denunciado">

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
                                <input id="accion" type="textarea" class="form-control @error('accion') is-invalid @enderror" name="accion" value="{{ old('accion', $expediente->accion) }}" required autocomplete="accion"></textarea>

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
                                <input id="terceros" type="text" class="form-control @error('terceros') is-invalid @enderror" name="terceros" value="{{ old('terceros', $expediente->terceros_interesados) }}" required autocomplete="terceros">

                                @error('terceros')
                                    <span class="invalid-feedback" role="alert">
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
                            <div class="input-group" >
                                <input type="text" class="form-control datepicker" name="fecha" id="fecha" value="{{ old('coadyuvantes',$expediente->fecha) }}"> 
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
                                <input type="text" class="form-control datepicker" name="hora" id="hora" value="{{ old('hora',$expediente->hora) }}">
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
                      <a href="{{ url( 'expediente/admin')}}"" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a> 
            </div>
        </div>
 
@endsection
