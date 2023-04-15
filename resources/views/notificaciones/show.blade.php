@extends('adminlte::page')

@section('title', 'Asigna Tareas')

@section('content_header')
<font color="#367068"><h1>Detalle de las notificaciones  del Tribunal de Justicia Electoral del Estado de Zacatecas</h1></font>
@stop
@blade
@section('content')

               
<div class="card"> 
                <h3></h3>
                   @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif
                    <div class="card-header" align="right">
                    </div>
                    <div class="card-body" >
                         <p><h4>Detalle:</h4></p>
                         <table class="table table-striped  table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Usuario(s) notificados</th>
                                        <th>Fecha y hora</th>
                                        <th>Herramientas</th>
                                      
                                        
                                    
                                    </tr>
                                </thead>
                                    @foreach($notificacion as $not)                                    
                                        <tr>
                                            <td>
                                                {{$not->buzones->users->name}}                                        
                                            </td> 
                                            <td>
                                                {{$not->created_at}}                                        
                                            </td>                                        
                                            <td width="10px" >
                                                <a href="#"><i class="fas fa-power-off" style="color:black"></i></a>  
                                            
                                            
                                                <a href="#" onclick="return confirm('¿Realmente desea elimiar el regisro?')"   ><i class="fas fa-trash-alt" style="color:black"></i></a>  
                                            </td>
                                        </tr>
                                
                                     @endforeach
                            </table>
                    </div>

                    
                    <div class="card-footer" align="right">  
                         
                      <a href="{{ route('admin_notificacion') }}" class="btn btn-dark" ><i class="fas fa-check-circle"></i>Regresar</a>        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection