@extends('adminlte::page')

@section('title', 'Tareas')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-tasks"> Tareas existentes para  roles dentro del Notrijez </i></h1></font>
@stop
@section('content')
<div class="card">
    
            <div class="card-header" align="right">
            <input class="form-control" placeholder="Escriba el nombre de la tarea">
            <div align="right">
              <a href="{{ route ('create_tarea' ) }}" class="btn btn-dark"><i class="fas fa-plus-circle"></i>Agregar Tarea</a>
            </div>
               <div class=card-body> 
                 <table class="table table-striped  table-sm">
                    <thead thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>                                               
                             <th>Herramientas</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tareas as $tarea)   
                            <tr>
                                <td>{{$tarea->id }}</td>
                                <td >{{$tarea->descripcion }}</td>
                                <td align="justify-content-center" width="10px"><a href="{{ url( 'tareas/'.$tarea->id.'/show')}}"  ><i class="fas fa-eye" style="color:black"></i></a>
                                <a href="{{ url('/tareas/'.$tarea->id.'/edit') }}" ><i class="fas fa-pencil-alt" style="color:black"></i></a>
                                <a href="{{ route('destroy_tarea',$tarea->id) }}" onclick="return confirm('¿Realmente desea elimiar el regisro?')"  ><i class="fas fa-trash-alt" style="color:black"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                 </table>
               </div>
               <div class="card-footer" align="right">
                    {{ $tareas->links() }}
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

