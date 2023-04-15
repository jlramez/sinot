@extends('adminlte::page')

@section('title', 'Detalle notificación')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-briefcase"> Reporte de Notificaciones para Actuarios(as) del Tribunal de Justicia Electoral del Estado de Zacatecas </i></h1></font>
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
                                            <th>Expediente</th>
                                            <th>Actuación</th>
                                            <th>Actor</th>                                            
                                            <th> Estátus</th>
                                            <th> Fecha notificación</th>
                                            <th> Fecha lectura</th>
                                            <th> Usuario(a) notificado(a)</th>
                                           
                                          
                                            
                                            
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach($notificaciones as $an)
                                        <tr align="center">
                                            <td>{{$an->notificaciones->asigna_actuaciones->expedientes->folio}}</td>
                                            <td>{{$an->notificaciones->asigna_actuaciones->actuacions->Nombre}}</td>
                                            <td>{{$an->notificaciones->asigna_actuaciones->expedientes->actor}}</td>
                                            @if($an->notificaciones->enviado==0)
                                             <td>                                           
                                                <span class="badge bg-warning">Por Notificar</span>  
                                            </td>
                                            @endif  
                                            @if($an->notificaciones->enviado==1)
                                                <td>                                           
                                                    <span class="badge bg-info">Notificada</span>  
                                                </td>
                                            @endif                                           
                                            <td>                                         
                                                    {{$an->created_at}}                                           
                                            </td>                                           
                                            <td>
                                                    {{$an->readed_at}} 
                                            </td>  
                                           
                                            <td>
                                                     {{$an->buzones->users->name}} 
                                            </td> 
                                           
                                            
                                           
                                    
                                              
                                        </tr>
                                        @endforeach
                                       
                                    </tbody>
                                </table>                                                             
                      </div> 
                        
                        
                       
                      
                        
                          
                        
                    </div>  
                    <div class="card-footer" align="right">    
                      {{{$notificaciones->links()}}}        
                    </div>                  
                    <div class="card-footer" align="right">    
                      <a href="{{ url('#') }}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
                    </div>
                </div>
            
</div>
@endsection