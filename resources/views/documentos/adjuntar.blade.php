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
<font color="#367068"><h1><i class="fas fa-file-medical"> Adjuntar documento para firma electrónica a las actuaciones de los expedientes  del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1></font>
@stop

@section('content')
            <div class="card">
                <div class="card-header">{{ __('Asigna archivos para firma a la actuación del expediente: ') }}{{$documentos->asigna_actuaciones->expedientes->folio}}</div>
                    <div class="card-body">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                     @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('save_dcto',$documentos->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group ">
                            <label for="folio" >{{ __('Expediente:') }}</label>

                            <div class="">
                                <input id="folio" type="text" class="form-control @error('folio') is-invalid @enderror" name="folio" value="{{ old('folio', $documentos->asigna_actuaciones->expedientes->folio) }}" required autocomplete="folio" required>
                                <input id="id_dcto" type="text" class="form-control @error('id_dcto') is-invalid @enderror" name="id_dcto" value="{{ old('folio', $documentos->id) }}" required autocomplete="id_dcto" >

                                @error('folio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="actuacion" >{{ __('Actuacion:') }}</label>

                            <div class="">
                                <input id="actuacion" type="text" class="form-control @error('actuacion') is-invalid @enderror" name="actuacion" value="{{ old('actuacion', $documentos->asigna_actuaciones->actuacions->Nombre) }}" required autocomplete="actuacion" required>

                                @error('actuacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="user_id" >{{ __('Usuario que genera documento:') }}</label>

                            <div class="">
                                <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name', auth()->user()->name) }}" required autocomplete="user_name" disabled>
                                <input id="user_id" type="hidden" value="{{ old('user_id', auth()->user()->id) }}" > 
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="res_act" >{{ __('Resumen actuación:') }}</label>

                            <div class="">
                                <input id="res_act" rows="5"  type="text" class="form-control @error('res_act') is-invalid @enderror" name="res_act" value="{{ old('res_act',$documentos->asigna_actuaciones->resumen_actuacion) }}" required autocomplete="res_act" disabled>

                                @error('res_act')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                     

                        <!--AUTORIZADA-->


                        <div class="form-group ">
                            <label for="documento" >{{ __('Adjunar archivo  PARA FIRMA ELECTRÓNICA :') }}</label>
                                <input id="documento" type="file"  name="documento"  required>
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
                      <a href="{{ url( 'expedientes/admin')}}"" class="btn btn-primary" ><i class="fas fa-file-word"></i>Adjuntar </a> 
                      <a href="{{ url( '/pdf/')}}" class="btn btn-danger" target="_blank" ><i class="fas fa-file-pdf"></i>  Generar archivo PDF</a>  --> 
                      <a href="{{ url( 'documento/admin')}}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a> 
                          
                    </div>
            </div>   
@endsection