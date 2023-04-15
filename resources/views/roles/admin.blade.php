@extends('adminlte::page')

@section('title', 'Roles de usuario')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-user-tag"> Roles de usuario del Sistema Notrijez</i></h1></font>
@stop
@section('content')
<div class="card">
              <div class="card-header">
    
                                                    
                                {{ Form::open(['route' => 'admin_rol', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
                                  
                                {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Escriba el rol']) }}
                                
                                    
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default">
                                            <span class="glyphicon glyphicon-search"><i class="fas fa-search"></i></span>
                                        </button>
                                    </div>                           
                                {{ Form::close() }}

                            <!--<input class="form-control" placeholder="Escriba el nombre y/o apellidos  de la empleada o empleado" name="nombre">-->

                        <div  align="right">
                                 <a href="{{ route ('create_rol' ) }}" class="btn btn-dark"><i class="fas fa-plus-circle"></i>Agregar Nuevo Rol</a>
                        </div>

               </div>
               <div class=card-body> 
                 <table class="table table-striped  table-sm">
                    <thead thead class="table-dark">                  
                        <tr>
                            <th>ID</th>
                            <th>Nombre rol</th> 
                            <th>Slug</th>
                            <th>Tareas</th>      
                            <th>Herramientas</th>
                            
                        </tr>
                    </thead>
                    <tbody> 
                    <tr>  
                    <php? 
                   $id_rol=2;
                   ?>
                    @foreach($roles as $rol)              
                                    <td>{{$rol->id }}</td>                        
                                    <td >{{$rol->descripcion }}</td> 
                                    <td >{{$rol->slug }}</td>
                                    <td>
                                      @foreach($rol->tareas as $tarea)
                                      <span class="badge badge-secondary">{{$tarea->descripcion}}</span>                                                           
                                      @endforeach
                                    </td>  
                                    <td width="10px"><a href="{{ url( 'asigna_tareas/'.$rol->id.'/show')}}" ><i class="fas fa-eye" style="color:black"></i></a>
                                    <a href="{{ url( 'roles/'.$rol->id.'/edit')}}"  ><i class="fas fa-pencil-alt" style="color:black"></i></a>
                                   <a href="{{route('destroy_rol',$rol->id )}}"
                                     onclick="return confirm('¿Realmente desea elimiar el regisro?')" > 
                                     <i class="fas fa-trash-alt" style="color:black"></i></a></td> 
                            </tr>
                        @endforeach
                    </tbody>
                 </table>
               </div>
               <div class="card-footer" align="right">
                   {{ $roles->links() }}
                </dic>   
              </div>                 
            </div>           
        </div>
    </div>
</div>
@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

