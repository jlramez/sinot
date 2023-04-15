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
<h1>Editar actuación de los expedientes del Tribunal de Justicia Electoral del Estado de Zacatecas</h1>
@stop

@section('content')

            <div class="card">
                <div class="card-header">{{ __('Editar actuación de expediente: ') }}</div>
                    <div class="card-body">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                     @endif
                <div class="card-body">
                    <form method="POST" action="{{ url('asigna_actuaciones/'.$aa->id.'/edit_aa') }}" enctype="multipart/form-data">
                    @method('put')
                        @csrf

                        <div class="form-group ">
                            <label for="estatus" >{{ __('Actuación:') }}</label>

                            <div class="">
                                  <select name="actuacion_id" id="actuacion_id" class="form-control">
                                    @foreach ($rsact as $actuacion) 
                                      <option value="{{ $actuacion->id }}">{{ $actuacion->Nombre }}</option>
                                     @endforeach
                                </select> 
                                @error('actuacion_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="folio" >{{ __('Expediente:') }}</label>

                            <div class="">
                                <input id="folio" type="text" class="form-control @error('folio') is-invalid @enderror" name="folio" value="{{ old('folio', $aa->folio) }}" required autocomplete="folio"  >
                                <input id="expedientes_id" type="hidden" name="expedientes_id" id="expedientes_id" value="{{$aa->expedientes_id}}">
                                @error('folio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="user_id" >{{ __('Usuario:') }}</label>

                            <div class="">
                                <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror" name="user_name" value="{{ old('user_name', auth()->user()->name) }}" required autocomplete="user_name" >
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
                            <input id="res_act" type="text" class="form-control @error('res_act') is-invalid @enderror" name="res_act" value="{{ old('resumen_actuacion', $aa->resumen_actuacion) }}" required autocomplete="res_act" >

                                @error('res_act')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                     

                        <!--AUTORIZADA-->
                        <div class="form-group ">
                            <label for="nombre_dcto" >{{ __('Archivo adjunto actual:') }}</label>

                            <div class="">
                            <a href="{{url('/storage/'.$aa->folio.'/'.$aa->nombre_dcto)}}">{{$aa->nombre_dcto}}</a>
                                @error('nombre_dcto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="res_act" >{{ __('Histórico adjuntos:') }}</label>
                                <table class="table table-stripped table-sm">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Folio</th>
                                            <th>Documento</th>
                                            <td> Fecha</td>
                                            <th>Herramientas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach($rsad as $documento)
                                        <tr>
                                            <td>{{$documento->id}}</td>
                                            <td>{{$documento->asigna_actuaciones->folio}}</td>
                                            <td>{{$documento->nombre_dcto}}</a></td>
                                            <td>{{$documento->created_at}}</td>
                                            <td width="10px"><a href="/storage/{{$documento->asigna_actuaciones->folio}}/{{$documento->code_name}}" target="_blank">
                                            <i class="fas fa-eye" style="color:black"></i></a>
                                            <a href="{{ url('/asigna_documentos/'.$documento->id) }}" onclick="return confirm('¿Realmente desea elimiar el regisro?')"    >
                                            <i class="fas fa-trash-alt" style="color:black"></i></a><td>
                                        </tr>
                                        @endforeach
                                       
                                    </tbody>
                                </table>
                            
                        </div>

                        <div class="form-group ">
                            <label for="documento" >{{ __('Agregar archivo(s) adjunto(s):') }}</label>
                                <input id="documento" type="file"  name="documento[]" multiple >
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
                      <!--<a href="{{ url( 'expedientes/admin')}}"" class="btn btn-danger" ><i class="fas fa-file-pdf"></i>Adjuntar </a>   
                      <a href="{{ url( 'expedientes/admin')}}"" class="btn btn-primary" ><i class="fas fa-file-word"></i>Adjuntar </a> --> 
                      <a href="{{ url( '/asigna_actuaciones/'.$aa->expedientes_id.'/show')}}"" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
                    </div>
            </div>
        
  
@endsection