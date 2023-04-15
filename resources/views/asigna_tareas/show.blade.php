@extends('adminlte::page')

@section('title', 'Asigna Tareas')

@section('content_header')
    <h1><i class="fas fa-tasks"> Tareas de los roles del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1>
@stop
@section('content')

               
<div class="card"> 
                <h3>{{ $roles->descripcion}}</h3>
                   @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif
                    <div class="card-header" align="right">
                    <a href="{{ url('/addtask/create/'.$roles->id) }}" class="btn btn-dark" ><i class="fas fa-plus-square"></i>Agregar Tarea</a> 
                    </div>
                    <div class="card-body" >
                         <p><h4>Tareas asignadas:</h4></p>
                         <table class="table table-striped  table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Status</th>
                                        <th>Herramientas</th>
                                      
                                        
                                    
                                    </tr>
                                </thead>
                                    @foreach($at as $tarea)                                    
                                        <tr>
                                            <td>
                                                {{$tarea->descripcion}}                                        
                                            </td>
                                                @if($tarea->activo==0)
                                                <td ><span class="badge badge-secondary">Desactivado</span></td>
                                                @endif
                                                @if($tarea->activo==1)
                                                <td><span class="badge badge-success">Activado</span></td>
                                                @endif                                        
                                            <td width="10px" >
                                                <a href="{{ url('/asigna_tareas/'.$tarea->id.'/edit') }}"><i class="fas fa-power-off" style="color:black"></i></a>  
                                            
                                            
                                                <a href="{{ url('/asigna_tareas/'.$tarea->id) }}" onclick="return confirm('¿Realmente desea elimiar el regisro?')"   ><i class="fas fa-trash-alt" style="color:black"></i></a>  
                                            </td>
                                        </tr>
                                
                                     @endforeach
                            </table>
                    </div>

                    
                    <div class="card-footer" align="right">  
                         
                      <a href="{{ url('/roles/admin') }}" class="btn btn-dark" ><i class="fas fa-step-backward"></i> Regresar</a>        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
