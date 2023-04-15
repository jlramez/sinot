<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

@section('title', 'Agregar actuaciones')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-folder-plus">Agregar documentos  a las actuaciones del expediente </i></h1></font>
@stop

@section('content')
            <div class="card">
                <div class="card-header">{{ __('Generar Documento  para la actuación ') }}<b>{{$aa->actuacions->Nombre}}</b></div>
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
                              <!-- <div class="{{session('type')}}" role="alert">
                                   {{ session('status')}}
                               </div>-->

                 @endif
            @endif
                    <form method="POST" action="{{ route('store_dcto', $aa->id) }}" >
                        @csrf

                        <div class="form-group ">
                            <label for="estatus" >{{ __('Nombre de la Actuación:') }}</label>

                            <div class="">
                            <input id="actuacion_nombre" type="text" class="form-control @error('actuacion_nombre') is-invalid @enderror" name="actuacion_nombre" value="{{ old('actuacion_nombre', $aa->actuacions->Nombre) }}" required autocomplete="actuacion_nombre" disabled>
                                @error('actuacion_nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="folio" >{{ __('Tipo de Juicio:') }}</label>

                            <div class="">
                            <input id="juicio_nombre" type="text" class="form-control @error('juicio_nombre') is-invalid @enderror" name="juicio_nombre" value="{{ old('juicio_nombre', $aa->expedientes->juicios->descripcion) }}" required autocomplete="juicio_nombre" disabled>

                                @error('juicio_nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="user_id" >{{ __('Expediente:') }}</label>

                            <div class="">
                            <input id="expediente" type="text" class="form-control @error('expediente') is-invalid @enderror" name="expediente" value="{{ old('expediente', $aa->expedientes->folio) }}" required autocomplete="expediente" disabled>

                                @error('expediente')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="user_id" >{{ __('Actor:') }}</label>

                            <div class="">
                            <input id="expediente" type="text" class="form-control @error('expediente') is-invalid @enderror" name="expediente" value="{{ old('expediente', $aa->expedientes->actor) }}" required autocomplete="expediente" disabled>

                                @error('expediente')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="user_id" >{{ __('Autoridad responsable:') }}</label>

                            <div class="">
                            <input id="expediente" type="text" class="form-control @error('expediente') is-invalid @enderror" name="expediente" value="{{ old('expediente', $aa->expedientes->denunciado) }}" required autocomplete="expediente" disabled>

                                @error('expediente')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="user_id" >{{ __('Magistrado Instructor:') }}</label>

                            <div class="">
                            <input id="expediente" type="text" class="form-control @error('expediente') is-invalid @enderror" name="expediente" value="{{ old('expediente', $aa->expedientes->ponencias->magistrados->nombre.' '. $aa->expedientes->ponencias->magistrados->primerapellido.' '. $aa->expedientes->ponencias->magistrados->segundoapellido) }}" required autocomplete="expediente" disabled>

                                @error('expediente')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--AUTORIZADA-->

                        <div class="form-group ">
                            <label for="texto" >{{ __('Texto Documento:') }}</label>

                            <div class="">
                             <textarea rows="3"  class="form-control @error('texto') is-invalid @enderror" name="texto" value="" autocomplete="texto"></textarea>

                                @error('texto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="estatus" >{{ __('Firmas:') }}</label>

                            <div class="">
                            <select name="perfilfirma_id" id="perfilfirma_id" class="form-control">
                                    @foreach ($rspf as $puesto) 
                                      <option value="{{ $puesto->id }}">{{ $puesto->descripcion }}</option>
                                     @endforeach
                                </select> 
                                @error('actuacion_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                    

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark"><i class="fas fa-check-circle"></i>
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer" align="right"> 
                     <!-- <a href="{{ url( 'expedientes/admin')}}"" class="btn btn-danger" ><i class="fas fa-file-pdf"></i>Adjuntar </a>   
                      <a href="{{ url( 'expedientes/admin')}}"" class="btn btn-primary" ><i class="fas fa-file-word"></i>Adjuntar </a> --> 
                      <!--<a href="{{ url( '/pdf/')}}" class="btn btn-danger" target="_blank" ><i class="fas fa-file-pdf"></i>  Generar archivo PDF</a> -->  
                      <a href="{{ url( 'asigna_actuaciones/'.$aa->expedientes->id.'/show')}}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a> 
                          
                </div>
            </div>   
@stop