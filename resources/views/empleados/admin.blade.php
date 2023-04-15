@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-users"> Empleados  del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1></font>
@stop

@section('content')
<div class="card">

    <div class="card-header">                        
                        {{ Form::open(['route' => 'admin_empleado', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
                          
                        {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Escriba el nombre o apellidos" name="nombre']) }}
                        
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-default">
                                    <span class="glyphicon glyphicon-search"><i class="fas fa-search"></i></span>
                                </button>
                            </div>                           
                        {{ Form::close() }}
                    
      <!--<input class="form-control" placeholder="Escriba el nombre y/o apellidos  de la empleada o empleado" name="nombre">-->

    <div align="right">
               <a href="{{ route ('create_empleado' ) }}" class="btn btn-dark"><i class="fas fa-plus-circle"></i>Agregar Empleado</a>
    </div>
</div>   
        <table class="table table-striped table-sm">
                    <thead class="table-dark">
                        <tr >
                            <th>ID</th>
                            <th >Nombre</th>                    
                            <th>Primer Apellido</th>
                            <th>Segundo Apellido</th>
                            <th>Puesto</th>
                            <th>Área</th>
                            <th>Magistrado(Sí/No)</th>
                            <th>Firmante</th>
                            <th>Herramientas</th>
                            
                           
                          </tr>
                     </thead>
                  <tbody>
                          @foreach($empleados as $empleado)
                              <tr>
                                  <td>{{$empleado->id }}</td>
                                  <td >{{$empleado->nombre }}</td>
                                  <td>{{$empleado->ap}}</td>
                                  <td>{{$empleado->am}}</td> 
                                  <td>{{$empleado->puestos->descripcion}}
                                  <td>{{$empleado->puestos->areas->descripcion}}                          
                                  @if($empleado->magistrado==0)
                                                <td ><span class="badge badge-secondary">No</span></td>
                                                @endif
                                                @if($empleado->magistrado==1)
                                                <td><span class="badge badge-success">Sí</span></td>
                                                @endif
                                  @if($empleado->firma==0)
                                                <td ><span class="badge badge-secondary">No</span></td>
                                                @endif
                                                @if($empleado->firma==1)
                                                <td><span class="badge badge-success">Sí</span></td>
                                                @endif     
                                             
                                
                                  <td><a href="{{ url( 'empleados/'.$empleado->id.'/show')}}" Title="Detalle de empleado"  ><i class="fas fa-eye" style="color:black"></i></a>
                                  <a href="{{ url( 'empleados/'.$empleado->id.'/firma')}}" Title="Asignar permiso para firmar"  ><i class="fas fa-pen-alt" style="color:black"></i></a>
                                  <a href="{{ url('empleados/'.$empleado->id.'/edit') }}" Title="Editar empleado"  ><i class="fas fa-pencil-alt" style="color:black"></i></a>
                                  <a href="{{ route('destroy_empleado',$empleado->id) }}" onclick="return confirm('¿Realmente desea elimiar el regisro?')" Title="Eliminar empleado" ><i class="fas fa-trash-alt" style="color:black"></i></a></td>
                              </tr>
                          @endforeach
                </tbody>
        </table>
                  <div class="card-footer" align="left">
                        {{ $empleados->links() }}
                  </div>                  
                  
</div>
@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

