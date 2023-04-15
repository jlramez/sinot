@extends('layouts.app')

@section('content')

    <div class="container">
            <div class="col-md-8">
                <h3>{{ $rol->descripcion}}</h3>
                <div class="card"> 
                   @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif
                    <div class="card-body" >
                         <p><h4>Tareas asignadas:</h4></p>
                         <table class="table table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Status</th>
                                        <th>Activar/Desactivar</th>
                                        <th>Borrar</th>
                                        
                                    
                                    </tr>
                                </thead>
                                    @foreach($at as $tarea)                                    
                                        <tr>
                                            <td>
                                                {{$tarea->descripcion}}                                        
                                            </td>
                                                @if($tarea->status==0)
                                                <td ><span class="badge badge-danger">Desactivado</span></td>
                                                @endif
                                                @if($tarea->status==1)
                                                <td><span class="badge badge-success">Activado</span></td>
                                                @endif                                        
                                            <td align="center">
                                                <a href="{{ url('/asigna_tareas/'.$tarea->id.'/activar') }}" class="btn btn-warning" ><i class="fas fa-power-off"></i></a>  
                                            </td>
                                            <td  align="middle">
                                                <a href="{{ url('/roles/'.$rol->id.'/removetask') }}" class="btn btn-danger" ><i class="fas fa-minus-circle"></i></a>  
                                            </td>
                                        </tr>
                                
                                     @endforeach
                            </table>
                    </div>

                    
                    <div class="card-footer" align="right">  
                      <a href="{{ url('/addtask/create/'.$rol->id) }}" class="btn btn-success" ><i class="fas fa-plus-square"></i>Agregar Tarea</a>     
                      <a href="{{ url('/roles/admin') }}" class="btn btn-success" ><i class="fas fa-check-circle"></i>Aceptar</a>        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
