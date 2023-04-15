@extends('adminlte::page')

@section('title', 'Documentos')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-folder"> Documentos del Sistema de  Notificación Electrónica del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1></font>
@stop

@section('content')
<div class="card">
            
    <div class="card-header">
    
                        
    {{ Form::open(['route' => 'admin_dcto', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}   
  
    {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Escriba el folio o actor']) }}
    
        
        <div class="form-group">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"><i class="fas fa-search"></i></span>
            </button>
        </div>                           
    {{ Form::close() }}

<!--<input class="form-control" placeholder="Escriba el nombre y/o apellidos  de la empleada o empleado" name="nombre">-->
            <div align="right">
              <!--<a href="{{ url('documentos/create' ) }}" class="btn btn-dark"><i class="fas fa-plus-circle"></i>Generar  Documento</a>-->
            </div>
            <div class="card-body">
            @if (session('status'))
                    @if (session('type'))
                            <div class="{{session('type')}}" role="alert">
                                {{ session('status')}}
                            </div>

                    @endif
                @endif
                <table class="table table-striped table-sm">
                    <thead class="table-dark" >
                        <tr align="center">
                            <th>ID</th>
                            <th>Expediente</th>
                            <th>Actuación</th>
                            <th >Firmantes</th>                            
                            <th >H.F. Adjunta</th>
                            <!--<th >Certificación SGA</th>
                            <th >Certificado</th>-->
                            <th >E-firma</th>                                                                                         
                            <th >Herramientas</th>
                           
                           
                          </tr>
                     </thead>
                     <tbody>
                          @foreach($documentos as $documento)
                             <tr align="center">
                                        <td>{{$documento->id}}</td>
                                        @if( $documento->asigna_actuaciones->certificado==1)
                                        <td>
                                            {{$documento->asigna_actuaciones->expedientes->folio}}
                                            @foreach($documento->asigna_actuaciones->certificaciones as $cert_id)
                                                <a href="{{ route( 'show_cert',$cert_id->id)}}"  title="Detalle certificacion">
                                                <span class="badge badge-info">Cert.</span></a>
                                            @endforeach
                                        </td>
                                        @endif 
                                        @if( $documento->asigna_actuaciones->certificado==0)
                                        <td>{{$documento->asigna_actuaciones->expedientes->folio}}</td>
                                        @endif   
                                        <td>{{$documento->asigna_actuaciones->actuacions->Nombre}}</td>
                                
                                                <td>
                                                        @foreach($documento->perfil_firmas->empleados as $empleado)
                                                            <span class="badge badge-secondary">{{$empleado->nombre}} {{$empleado->ap}} {{$empleado->am}}</span>                                                           
                                                        @endforeach
                                                </td> 
                                                @if($documento->nombre_dcto!=null)
                                                <td>
                                                <span class="badge badge-success">H.F. adjuntada</span>                                                           
                                                </td>
                                                @endif
                                                @if($documento->nombre_dcto==null)
                                                <td>
                                                <span class="badge badge-warning">Sin documento</span>                                                           
                                                </td>
                                                @endif
                                               
                                                        @if($documento->estatus==1)
                                                        <td>
                                                            <span class="badge badge-secondary">Sin Documento</span>   
                                                        </td>
                                                        @endif
                                                    
                                                <!--
                                                @foreach($documento->asigna_actuaciones->certificaciones as $estatus)
                                                                                                    
                                                                @if($estatus->estatus==1)
                                                                        <td>
                                                                            <span class="badge badge-success">Aceptada</span>   
                                                                        </td>
                                                                                                                
                                                                @endif
                                                                
                                                                
                                                        
                                                                @if($estatus->estatus==0)
                                                                    <td>
                                                                        <a href="{{ route( 'edit_certificaciones', $estatus->id)}}"><span class="badge badge-danger">Rechazada</span></a>  
                                                                    </td>
                                                                @endif                                              
                                                            @if($estatus->firmada==1)
                                                                    <td>
                                                                        <span class="badge badge-success">Sí</span>
                                                                    </td>
                                                            @endif
                                                            @if($estatus->firmada==0)
                                                                    <td>
                                                                        <span class="badge badge-danger">No</span>
                                                                    </td>
                                                            @endif                                                  
                                                
                                                    
                                                @endforeach -->
                                                                    
                                                @if($documento->firmado==1)
                                                <td>
                                                <span class="badge badge-success">Firmado</span>                                                           
                                                </td>
                                                @endif
                                                @if($documento->firmado==0)
                                                <td>
                                                <span class="badge badge-warning">Sin e-firma</span>                                                           
                                                </td>
                                                @endif  
                                                    <td align="left" width="450px">
                                                        <a href="{{ route( 'adjuntar_dcto',$documento->id)}} " title="Agregar"  type="button" class="btn btn-outline-secondary" >Adj_HF.</a>
                                                                                        
                                                                                        
                                                            @if($documento->nombre_dcto!=null)
                                                        
                                                            <a href="{{ route( 'efirma_dcto', $documento->id)}} " title="Firmar"  type="button" class="btn btn-outline-danger">Firmar </a>
                                                            
                                                            @endif
                                                            @if($documento->nombre_dcto==null)
                                                        
                                                            @endif
                                                
                                                            @if($documento->firmado==1)
                                                            
                                                                    <a href="{{ url( '/pdf/actuaciones/'.$documento->asigna_actuaciones_id)}}" title="Firmar"  type="button" class="btn btn-outline-info">Descargar</a>                                                      
                                                            
                                                            @endif
                                                            @if($documento->firmado==0)
                                                                
                                                            @endif    
                                                            @if($documento->firmado==1)
                                                            
                                                                    <a href="{{ url( '/notificacion/self/'.$documento->asigna_actuaciones_id)}}" title="Firmar"  type="button" class="btn btn-outline-success">GenerarN.</a>                                                      
                                                                
                                                            @endif
                                                            @if($documento->firmado==0)
                                                                
                                                            @endif
                                                    </td>                                      
                                          
                                            
                              </tr>
                          @endforeach
                    </tbody>
                 </table>
            </div>
            <div align="Right">
                <a href="{{ route( 'admin_notificacion')}}" class="btn btn-dark" ><i class="fas fa-bell"></i> Ir a Notificaciones</a> 
            </div> 
                  <div class="card-footer" align="left">
                        {{ $documentos->links() }}
                  </div>                  
                  *Generar N.- Generar Notificación , Adj_HF.- Adjuntar Hoja de Firmas
    </div>
</div>
@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
