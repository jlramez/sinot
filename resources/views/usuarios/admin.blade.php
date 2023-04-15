
@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-user"> Usuarios del Sistema de  Notificación Electrónica del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1></font>
@stop
@section('content')
<div class="card">
@if (session('status'))
                    @if (session('type'))
                            <div class="{{session('type')}}" role="alert">
                                {{ session('status')}}
                            </div>

                    @endif
                @endif
                
            <div class="card-header">
            {{ Form::open(['route' => 'admin_user', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}   
  
            {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Escriba el nombre']) }}


                        <div class="form-group">
                            <button type="submit" class="btn btn-default">
                                <span class="glyphicon glyphicon-search"><i class="fas fa-search"></i></span>
                            </button>
                        </div>                           
            {{ Form::close() }}
            <div  align="right">
           
              <a href="{{ url('usuarios/create/' ) }}" class="btn btn-dark"><i class="fas fa-plus-circle"></i> Agregar Usuario</a>
              <a href="{{ url('usuarios/create/externo' ) }}" class="btn btn-dark"><i class="fas fa-plus-circle"></i> Agregar Usuario Externo</a>
            </div>
               <div class=card-body> 
              
                 <table class="table table-striped  table-sm">
                    <thead thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th >Nombre</th>                    
                            <th>Correo electrónico</th>
                            <!--<th>Rol</th>-->
                            <th>CURP</th>
                            <th>Tipo</th>
                            <th>Estatus</th>
                            <th>Último Acceso</th>
                            <th> Herramientas</th>
                           
                          </tr>
                     </thead>
                     <tbody>
                          @foreach($usuarios as  $usuario)
                              <tr>
                                  <td>{{$usuario->id }}</td>
                                  <td >{{$usuario->name }}</td>
                                  <td>{{$usuario->email}}</td>                                 
                                  <td>{{$usuario->CURP}} </td>
                                 
                                  @if($usuario->externo==0)
                                                <td ><span class="badge badge-secondary">Interno</span></td>
                                                @endif
                                                @if($usuario->externo==1)
                                                <td><span class="badge badge-secondary">Externo</span></td>
                                                @endif                                   
                                  @if($usuario->activo==0)
                                                <td ><span class="badge badge-secondary">Desactivado</span></td>
                                                @endif
                                                @if($usuario->activo==1)
                                                <td><span class="badge badge-success">Activado</span></td>
                                                @endif      
                                                <td>{{$usuario->last_login}}</td>                                     
                                  <td><a href="{{ route( 'show_addrol', $usuario->id)}}" title="ver permisos" ><i class="fas fa-tasks" style="color:black"></i></a> 
                                  <a href="{{ url( 'usuarios/'.$usuario->id.'/activate')}}" title="Activar/Desactivar"><i class="fas fa-power-off" style="color:black"></i></a> 
                                  <a href="{{ url( 'usuarios/'.$usuario->id.'/show')}}" title="ver detalle"><i class="fas fa-eye" style="color:black"></i></a>
                                  <a href="{{ url('usuarios/'.$usuario->id.'/edit') }}" title="Editar Usuario"><i class="fas fa-pencil-alt" style="color:black"></i></a>
                                  <a href="{{ url( '/pdf/'.$usuario->id)}}"  target="_blank" title="Imprimir Acuse"><i class="fas fa-print" style="color:black"></i></a>
                                  <a href="{{ url( '/addexp/'.$usuario->id.'/show')}}"  title="Asignar expedientes"><i class="fas fa-folder-plus" style="color:black"></i></a>
                                  <a href="{{ route('destroy_usuario',$usuario->id) }}" title="Borrar Usuario" onclick="return confirm('¿Realmente desea elimiar el regisro?')"  ><i class="fas fa-minus-circle" style="color:black"></i></a></td>
                              </tr>
                          @endforeach
                          <tr >
                            <td align="right" colspan="7">
                            <!--<a href="{{ url('usuarios/create/' ) }}" class="btn btn-dark"><i class="fas fa-file"></i> Generar Acuse</a>-->
                            </td>
                          </tr>
                    </tbody>
                 </table>
                </div>
                  <div class="card-footer" float="left">              
                     
                        {{ $usuarios->links() }}
                 </div>                                   
        </div>
  
@endsection