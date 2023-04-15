@extends('adminlte::page')

@section('title', 'Notificaciones')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-bell">Notificaciones de los Medios de Impugnación del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1></font>
@stop
@section('content')
<div class="card">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                         @endif
                <div class="card-header">                 
                                        
                                {{ Form::open(['route' => 'admin_notificacion', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
                                
                                {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Escriba la fecha de la notificación']) }}
                                
                                    
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default">
                                            <span class="glyphicon glyphicon-search"><i class="fas fa-search"></i></span>
                                        </button>
                                    </div>                           
                                {{ Form::close() }}

                            <!--<input class="form-control" placeholder="Escriba el nombre y/o apellidos  de la empleada o empleado" name="nombre">-->

                                        <div  align="right">
                                         <!--<a href="{{ route ('create_notificacion' ) }}" class="btn btn-dark"><i class="fas fa-plus-circle"></i>Agregar Notificación</a>-->
                                        </div>
         
                </div>
               <div class=card-body> 
                 <table class="table table-striped  table-sm">
                    <thead class="table-dark">
                        <tr align="center">
                            <!--<th>ID</th>-->
                            <th >ID</th>
                            <th >Expediente</th>                    
                            <th>Actor</th>                            
                            <th>Actuación</th>
                            <th>Autorización</th>
                            <th>Enviada</th>
                                                         
                            <th>Herramientas</th>
                           
                          </tr>
                     </thead >
                     <tbody>
                          @foreach($notificaciones as $notificacion)
                              <tr align="center">
                                  <td>{{$notificacion->id }}</td>
                                  <td >{{$notificacion->asigna_actuaciones->folio}}</td>
                                  <td>{{$notificacion->asigna_actuaciones->expedientes->actor}}</td>                                                                
                                  <td>{{$notificacion->asigna_actuaciones->actuacions->Nombre}}</td>
                                
                                                @if($notificacion->autorizada==0)
                                                     <td ><span class="badge badge-secondary">No-Autorizada</span></td>
                                                @endif
                                                @if($notificacion->autorizada==1)
                                                     <td><span class="badge badge-success">Autorizada</span></td>
                                                @endif
                                                @if($notificacion->enviado==0)
                                                     <td ><span class="badge badge-warning">Sin-enviar</span></td>
                                                @endif
                                                @if($notificacion->enviado==1)
                                                     <td><span class="badge badge-success">Enviada</span></td>
                                                @endif                                       
                                  <td >
                                        @canany(['admin','actuario','sga'])
                                        <a href="{{ route( 'show_notificaciones', $notificacion->id)}}" title="Detalle Notificación" class="btn btn-outline-secondary">Detalle</a> 
                                        @endcanany
                                        @canany(['admin','sga'])
                                        <a href="{{ url( '/notificaciones/'.$notificacion->id.'/autorizar')}}"  title="Autorizar notificación" class="btn btn-outline-success">Autorizar</a>
                                        @endcanany
                                        
                                        @if($notificacion->autorizada==1)
                                                @canany(['admin','actuario'])
                                                        <a href="{{ url('/asigna_notificaciones/self/'.$notificacion->asigna_actuaciones_id.'') }}" onclick="return confirm('¿Realmente desea ENVIAR la notificación')"  title="Enviar notificación" class="btn btn-outline-primary">Enviar N.</i></a>                                               
                                                @endcanany
                                        @endif



                                        <!-- @if($notificacion->autorizada==0)
                                        <a href="{{ url( '/asigna_notificaciones/'.$notificacion->id.'/create')}}"  title="Enviar notificación" class="btn btn-outline-secondary">Enviar N.</a>
                                        @endif
                                        @if($notificacion->autorizada==1)
                                        <a href="{{ url( '/asigna_notificaciones/'.$notificacion->id.'/create')}}" title="Enviar notificación" class="btn btn-outline-secondary" >Enviar N.</a>
                                        @endif-->
                                        @can('admin') 
                                        <a href="{{ route('destroy_notificacion',$notificacion->id) }}" onclick="return confirm('¿Realmente desea elimiar el regisro?')" title="Eliminar notificación" class="btn btn-outline-danger" >Eliminar</a>
                                        @endcan
                                  </td>
                              </tr>
                          @endforeach
                    </tbody>
                 </table>
                </div>
                  <div class="card-footer" align="left">
                        {{ $notificaciones->links() }}
                  </div>   
                  *Enviar N.- Enviar Notificación                
        </div>
    </div>
</div>

@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop



