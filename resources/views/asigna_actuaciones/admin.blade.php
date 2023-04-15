@extends('adminlte::page')

@section('title', ' Asigna actuaciones')

@section('content_header')
<h1><i class="fas fa-folder-plus"> Asignar actuaciones a expediente </i></h1>
@stop

@section('content')
                   
                <div class="card"> 
              
                   <div class="card-header" align="right">
                  @canany(['admin','seceyc'])
                   <a href="{{ url('/addact/create/'.$expediente->id) }}" class="btn btn-dark" ><i class="fas fa-plus-circle"></i>Agregar Actuación</a> 
                  @endcanany
            </div>
                    <div class="card-body" >
                    @if (session('status'))
                         @if (session('type'))
                            <div class="{{session('type')}}" role="alert">
                                {{ session('status')}}
                            </div>

                        @endif
                    @endif
                    <div class="form-control">
                    <h4><label>Expediente</label>
                    </div>
                    <div class="form-control">
                        {{ $expediente->folio}}</h4>
                    </div>
                         <p><h5>Actuaciones realizadas:</h5></p>
                         <table class="table table-striped  table-sm">
                                <thead thead class="table-dark">
                                    <tr align="center">
                                        <!--<th>ID</th>-->
                                        <th>Expediente</th>
                                        <th>Actuación</th>
                                       <th>Actor / Denunciante</th>
                                      <!-- <th>A.R. / Denunciado</th>-->                                       
                                       <!--<th>Archivo Adjunto</th>-->
                                       <th>Acuerdo adjunto</th>
                                       <th>Para Certificación</th>
                                       <th>Documento certificación</th>
                                      
                                        <th align="center">Herramientas</th>
                                       
                                      
                                        
                                    
                                    </tr>
                                </thead>
                                    @foreach($aa as $actuacion)                                    
                                        <tr align="center">
                                        <!--<td>
                                                {{$actuacion->id}}                                        
                                            </td>-->
                                            <td>
                                            <a href="{{ url('/asigna_actuaciones/show/'.$actuacion->id) }}">{{$actuacion->folio}}</a>                                        
                                            </td>
                                            <td>
                                                {{$actuacion->actuacions->Nombre}}                                        
                                            </td>
                                            <td>
                                                {{$expediente->actor}}                                        
                                            </td>
                                            
                                            <!--<td>
                                                {{$expediente->denunciado}}                                        
                                            </td>-->
                                                <td >
                                                     @foreach($actuacion->asigna_documentos as $documentos)
                                                         <a href="{{asset('public/documentos/N_P_2.pdf')}}"><span class="badge bg-secondary">{{$documentos->nombre_dcto}}</span></a>
                                                     @endforeach                                                   
                                                </td>  
                                                @if ($actuacion->certificado==1)
                                                    <td>
                                                    <span class="badge badge-success"> Sí <span>                                      
                                                    </td>
                                                @endif
                                                 @if ($actuacion->certificado==0)
                                                    <td>
                                                    <span class="badge badge-secondary">No Aplica</span>                                    
                                                    </td>
                                                 @endif
                                                 @if ($actuacion->adjunto==1)
                                                    <td>
                                                    <span class="badge badge-success"> Documento adjuntado <span>                                      
                                                    </td>
                                                @endif
                                                    @if ($actuacion->adjunto==0)
                                                    <td>
                                                    <span class="badge badge-warning">Sin Documento</span>                                    
                                                    </td>
                                                 @endif  
                                                <td width="400px" align="left" >
                                            <!--<a href="{{ url('/asigna_actuaciones/'.$actuacion->id.'/edit') }}"  title="Autorizar actuación"  ><i class="fas fa-power-off" style="color:black"></i></a> --> 
                                            @if($existe>0)
                                             <!--@if($actuacion->autorizada==1)
                                                <a href="{{ url('/asigna_notificaciones/self/'.$actuacion->id.'') }}" onclick="return confirm('¿Realmente desea ENVIAR la notificación')"  title="Enviar notificación" disabled><i class="fas fa-envelope-open-text" style="color:black"></i></a>                                               
                                             @endif-->
                                            @endif
                                            @canany(['admin','actuario'])
                                            @if($actuacion->certificado==1)
                                                    <a href="{{ url( '/certificaciones/'.$actuacion->id.'/create')}}" class="btn btn-outline-info" title="Adjuntar documento(s) para certioficacion">Adj. Dctos Cert.<!--<i class="fas fa-file-download" style="color:black"></i>--></a> 
                                            @endif
                                            

                                                <a href="{{ url('/documentos/'.$actuacion->id.'/create') }}"  class="btn btn-outline-secondary" title="Generar documento" >Generar HF.<!--<i class="fas fa-file-upload" style="color:black"></i>--></a>  
                                                <a href="{{ url( '/pdf/actuaciones/'.$actuacion->id)}}" class="btn btn-outline-danger" title="Descargar documento">Descargar HF.<!--<i class="fas fa-file-download" style="color:black"></i>--></a> 
                                                
                                            @endcanany
                                            
                                       <!--@if($actuacion->autorizada==1)
                                                 <a href="{{ url('/notificacion/self/'.$actuacion->id) }}" onclick="return confirm('¿Realmente desea GENERAR la notificación')" class="btn btn-outline-info"  title="Generar notificación">Generar N.<i class="fas fa-file-import" style="color:black"></i></a>-->
                                           <!-- @endif -->
                                            @canany(['admin','seceyc'])
                                            <a href="{{ url('/asigna_actuaciones/'.$actuacion->id.'/edit_actuaciones') }}" title="Editar actuación" ><i class="fas fa-pencil-alt" style="color:black"></i></a>
                                            @endcanany
                                            @can('admin')
                                            <a href="{{ url('/asigna_actuaciones/'.$actuacion->id) }}" onclick="return confirm('¿Realmente desea elimiar el regisro?')"  title="Eliminar actuación"  ><i class="fas fa-trash-alt" style="color:black"></i></a>  
                                            @endcanany
                                            </td>
                                           
                                        </tr>
                                
                                     @endforeach
                            </table>
                    </div>

                    
                    <div class="card-footer" align="right">  
                         <a href="{{ url('/expedientes/admin') }}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
                    </div>
                    *HF- Hoja de Firmas, N- Notificacón 
                </div>
            </div>
      
@endsection

