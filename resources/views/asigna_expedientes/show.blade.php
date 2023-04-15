@extends('adminlte::page')

@section('title', 'Mostrar Expedientes')

@section('content_header')
    <h1>Mostrar  expedientes de usuarios</h1>
@stop

@section('content')
               
<div class="card"> 
                
                   @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif
                   <div class="card-header"><h>{{ __('Mostrar Expediente asignados al usuario '.$usuario->name) }} </h3> </div>
                    <div  align="right">
                        <a href="{{ url('/addexp/create/'.$usuario->id) }}" class="btn btn-dark" ><i class="fas fa-folder-plus"></i>Asignar Expediente</a> 
                    </div>
                    <div class="card-body" >
                         <table class="table table-striped  table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Folio</th>
                                        <th>Actor</th>
                                        <th>Herramientas</th>                                 
                                    </tr>
                                </thead>
                                    @foreach($ae as $expediente)                                    
                                        <tr>
                                            <td>
                                                {{$expediente->expedientes->folio}}                                        
                                            </td>
                                            <td>
                                              {{ $expediente->expedientes->actor}}
                                            </td>
                                                                                 
                                            <td width="10px" >
                                                <a href="{{ url('/asigna_expedientes/'.$expediente->id.'/edit') }}"><i class="fas fa-power-off" style="color:black"></i></a>  
                                            
                                            
                                                <a href="{{ url('/asigna_expedientes/'.$expediente->id) }}" onclick="return confirm('¿Realmente desea elimiar el regisro?')"   ><i class="fas fa-trash-alt" style="color:black"></i></a>  
                                            </td>
                                        </tr>
                                
                                     @endforeach
                            </table>
                    </div>

                    
                    <div class="card-footer" align="right">  
                         
                      <a href="{{ url('/usuarios/admin') }}" class="btn btn-dark" ><i class="fas fa-check-circle"></i>Aceptar</a>        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
