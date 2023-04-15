@extends('adminlte::page')

@section('title', 'Detalle notificación')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-book"> Reporte de Notificaciones para Magistradas y Magistrados del Tribunal de Justicia Electoral del Estado de Zacatecas </i></h1></font>
@stop

@section('content')
 <div class="card">
                     @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif
                   <div class="card-header">
    
                                                
                                                        {{ Form::open(['route' => 'reporte_magistrado', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
                                                        
                                                        {{ Form::text('search_reporte', null, ['class' => 'form-control', 'placeholder' => 'Escriba dato']) }}
                                                        
                                                            
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-default">
                                                                    <span class="glyphicon glyphicon-search"><i class="fas fa-search"></i></span>
                                                                </button>
                                                            </div>                           
                                                        {{ Form::close() }}

                                                    <!--<input class="form-control" placeholder="Escriba el nombre y/o apellidos  de la empleada o empleado" name="nombre">-->

                                                                
                     </div>
  
                 
                    <div class="card-body" >                
                         
                         <table class="table table-stripped table-sm">
                                    <thead class="table-dark">
                                        <tr align="center">
                                            <th>Ponencia</th>
                                            <th>Folio</th>
                                            <th>Actuación</th>                                            
                                            <th> Estátus</th>
                                            <th> Fecha notificación</th>
                                            <th> Fecha lectura</th>
                                            <th > Documentos</th>
                                            
                                            
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach($aa  as $asigna_actuacion)
                                        <tr align="center">
                                            <td>{{$asigna_actuacion->expedientes->ponencias->descripcion}}</td>
                                            <td>{{$asigna_actuacion->folio}}</td>
                                            <td>{{$asigna_actuacion->actuacions->Nombre}}</td>
                                          
                                             <td>                                           
                                                 
                                                <span class="badge bg-info">Notificada</span>  
                                            </td>
                                            <td>
                                                        @foreach($asigna_actuacion->documentos as $archivo)
                                                            {{$archivo->notificaciones}}
                                                        @endforeach
                                            </td>
                                            <td>
                                                        @foreach($asigna_actuacion->notificaciones as $notificacion)
                                                            @foreach($notificacion->asigna_notificaciones as $an)  
                                                                {{$an->readed_at}}
                                                            @endforeach          
                                                        @endforeach
                                            </td>  
                                           
                                           <td width="350px" align="left">                                           
                                                    @foreach($asigna_actuacion->asigna_documentos as $archivo)
                                                            <a class="btn btn-outline-secondary" href="/storage/{{$asigna_actuacion->folio}}/{{$asigna_actuacion->actuacions->Nombre}}/{{$archivo->nombre_dcto}}" target="_blank">
                                                            Archivo(s)</a>
                                                    @endforeach                                       
            
                                                    @foreach($asigna_actuacion->documentos as $hf)                                           
                                                            <a class="btn btn-outline-info" href="{{ url( '/pdf/actuaciones/'.$asigna_actuacion->id)}}" target="_blank">
                                                            Descargar HF. </span></a>
                                                    @endforeach
                                            @can('admin')
                                                <a href="{{ route('destroy_addnot', $asigna_actuacion->asigna_documentos[0]->id ) }}" onclick="return confirm('¿Realmente desea elimiar el regisro?')"    >
                                                <i class="fas fa-trash-alt" style="color:black"></i></a>
                                            @endcan
                                            </td>
                                              
                                        </tr>
                                        @endforeach
                                       
                                    </tbody>
                                </table>                                                             
                      </div> 
                        
                        
                       
                      
                        
                          
                        
                    </div>  
                    <div class="card-footer" align="right">    
                      {{{$aa->links()}}}        
                    </div>                  
                    <div class="card-footer" align="right">    
                      <a href="{{ url('#') }}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
                    </div>
                </div>
            
</div>
@endsection