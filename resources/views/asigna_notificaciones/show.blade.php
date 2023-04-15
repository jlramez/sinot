@extends('adminlte::page')

@section('title', 'Detalle notificación')

@section('content_header')
   
@stop

@section('content')
 <div class="card">
                     @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif
            <div class="card-header">
            <i class="fas fa-info-circle"></i>
            <p><label>Remitente:</label> Tribunal de Justicia Electoral del Estado de Zacatecas<!--, {{$an->notificaciones->asigna_actuaciones->expedientes->ponencias->magistrados->primerapellido}}</p>
            {{$an->notificaciones->asigna_actuaciones->expedientes->ponencias->magistrados->segundoapellido}}
            {{$an->notificaciones->asigna_actuaciones->expedientes->ponencias->magistrados->nombre}}--></p>
            <p><label>Fecha de la notificación: </label> {{ date('d/m/Y ',strtotime($an->created_at))}}</p>
            <p><label>Asunto:</label>Notificación electrónica de <b> {{$an->notificaciones->asigna_actuaciones->actuacions->Nombre}}</b> del expediente {{$an->notificaciones->asigna_actuaciones->expedientes->folio}} </p>
            <p><label>Para:</label> {{$an->notificaciones->asigna_actuaciones->expedientes->actor}}</p>
            </div>
                 
                    <div class="card-body" >
                    <div class="form-group ">
                            <label for="folio" >{{ __('Actuación') }}</label>

                            <div class="">
                                <input id="folio" type="text" class="form-control @error('folio') is-invalid @enderror" 
                                name="folio" value="{{ old('folio', $an->notificaciones->asigna_actuaciones->actuacions->Nombre) }}" required autocomplete="folio" disabled>

                                @error('folio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    </div>
                    
                         <p><label for="folio" >{{ __('Archivo(s) Adjunto(s)') }}</label></p>
                         <table class="table table-stripped table-sm">
                                    <thead class="table-dark">
                                        <tr align="center">
                                            <th>#</th>
                                            <th>Folio</th>
                                            <th>Documento(s) Adjunto(s)</th>
                                            <th>Hoja de Firmas (HF.)</th>
                                            <th> Fecha</th>
                                            <th>Herramientas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach($aa as $documento)
                                        <tr align="center">
                                            <td>{{$documento->notificaciones->asigna_actuaciones->id}}</td>
                                            <td>{{$documento->notificaciones->asigna_actuaciones->folio}}</td>
                                            <td>
                                                @foreach($documento->notificaciones->asigna_actuaciones->asigna_documentos as $archivo)
                                                    <a href="/storage/{{$documento->notificaciones->asigna_actuaciones->folio}}/{{$documento->notificaciones->asigna_actuaciones->actuacions->Nombre}}/{{$archivo->nombre_dcto}}" target="_blank">
                                                    <span class="badge bg-secondary">{{$archivo->nombre_dcto}}</span></a>
                                               @endforeach
                                            <td>
                                            
                                            <a href="{{ url( '/pdf/actuaciones/'.$documento->notificaciones->asigna_actuaciones->id)}}" target="_blank">
                                            <span class="badge bg-secondary">{{$hf}}</span></a>
                                             </td>
                                            <td>{{$documento->created_at}}</td>
                                           <td width="10px">
                                                <!--<a href="/storage/{{$documento->notificaciones->asigna_actuaciones->folio}}/{{$documento->notificaciones->asigna_actuaciones->actuacions->Nombre}}/{{$hf}}" target="_blank">
                                                    <i class="fas fa-eye" style="color:black"></i></a>-->
                                             
                                                <a href="{{ route('destroy_addnot', $documento->id ) }}" onclick="return confirm('¿Realmente desea elimiar el regisro?')"    >
                                                <i class="fas fa-trash-alt" style="color:black"></i></a>
                                            <td>
                                              
                                        </tr>
                                        @endforeach
                                       
                                    </tbody>
                                </table>
                                 
                        
                                  <div class="form-group ">
                            <label for="folio" >{{ __('Resúmen actuación') }}</label>

                            <div class="">
                                <input id="folio" type="text" class="form-control @error('folio') is-invalid @enderror" 
                                name="folio" value="{{ old('folio',$an->notificaciones->asigna_actuaciones->resumen_actuacion ) }}" required autocomplete="folio" disabled>

                                @error('folio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    </div> 
                        
                        
                       
                      
                        
                          
                        
                    </div>                    
                    <div class="card-footer" align="right">    
                      <a href="{{ url('/asigna_notificaciones/'.$an->buzones_id.'/show') }}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
                    </div>
                </div>
            
</div>
@endsection