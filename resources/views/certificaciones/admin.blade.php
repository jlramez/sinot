@extends('adminlte::page')

@section('title', 'Documentos')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-folder"> Certificaciones Documentos del Sistema de  Notificación Electrónica del TRIJEZ</i></h1></font>
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
                            <th >Documento por Certificar</th>                                                                                                       
                            <th >Certificado</th>
                            <th >Estátus</th>                
                            <th colspan="5">Herramientas</th>
                           
                           
                          </tr>
                     </thead>
                     <tbody>
                          @foreach($certificaciones as $certificacion)
                             <tr align="center">
                                        <td>{{$certificacion->id}}</td>
                                        <td>{{$certificacion->asigna_actuaciones->expedientes->folio}}</td>
                                           
                                        <td>{{$certificacion->asigna_actuaciones->actuacions->Nombre}}</td>
                                
                                                <td>
                                                <a href="/storage/{{$certificacion->asigna_actuaciones->folio}}/{{$certificacion->asigna_actuaciones->actuacions->Nombre}}/certificaciones/{{$certificacion->nombre_dcto}}" target="_blank">
                                                    <span class="badge bg-secondary">{{$certificacion->nombre_dcto}}</span></a>
                                                </td> 
                                                @if($certificacion->firmada==0)
                                                <td>
                                                <span class="badge badge-warning">Por certificar</span>                                                           
                                                </td>
                                                @endif
                                                @if($certificacion->firmada==1)
                                                <td>
                                                <span class="badge badge-success">Certificado</span>                                                           
                                                </td>
                                                @endif
                                                @if($certificacion->estatus==1)
                                                <td>
                                                <span class="badge badge-success">Aceptado</span>                                                           
                                                </td>
                                                @endif
                                                @if($certificacion->estatus==0)
                                                <td>
                                                <span class="badge badge-danger">Rechazado</span>                                                           
                                                </td>
                                                @endif
                                                    @if($certificacion->nombre_dcto!=null)                                                  
                                                    <td width="10px">
                                                    <a href="{{ route( 'autorizar_certificacion', $certificacion->id)}} " title="Rechazar documento"  type="button" class="btn btn-outline-danger">Rechazar </a>                                                    
                                                    </td>
                                                    @endif
                                                    @if($certificacion->nombre_dcto==null)
                                                    <td>
                                                
                                                    </td>
                                                    @endif                                                                        
                                                    @if($certificacion->nombre_dcto!=null && $certificacion->estatus!=0)                                                  
                                                    <td width="10px">
                                                    <a href="{{ route( 'firma_certificaciones', $certificacion->id)}} " title="Certificar"  type="button" class="btn btn-outline-success">Certificar </a>                                                    
                                                    </td>
                                                    @endif
                                                    @if($certificacion->nombre_dcto==null && $certificacion->estatus==0)
                                                    <td>
                                                
                                                    </td>
                                                    @endif
                                                    @if($certificacion->nombre_dcto!=null && $certificacion->estatus!=0)                                                  
                                                    <td width="10px">
                                                    <a href="{{ route( 'descargar_cedulaPDF', $certificacion->id)}} " title="Imprimir Cédula"  type="button" class="btn btn-outline-info">Cédula </a>                                                    
                                                    </td>
                                                    @endif 
                                                    @if($certificacion->nombre_dcto==null && $certificacion->estatus==0)
                                                    <td>
                                                
                                                    </td>
                                                    @endif
                                                    
                                                                                                                                        
                              </tr>
                          @endforeach
                    </tbody>
                 </table>
            </div>
            <div align="Right">
                <a href="{{ route( 'admin_dcto')}}" class="btn btn-dark" ><i class="fas fa-folder"></i> Ir a Documentos</a> 
            </div> 
                  <div class="card-footer" align="left">
                        {{ $certificaciones->links() }}
                  </div>                  
                  
    </div>
</div>
@stop

@section('css')
    
@stop

@section('js')
   
@stop
