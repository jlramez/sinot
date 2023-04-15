@extends('adminlte::page')

@section('content')

               
<div class="card"> 
                <h3>{{ $usuario->name}}</h3>
                   @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif
                   <div class="card-header"align="right"> 
                   <a href="{{ url('/addrol/create/'.$usuario->id) }}" class="btn btn-dark" ><i class="fas fa-plus-square"></i>Agregar roles</a>
                   </div>
                    <div class="card-body" >
                         <p><h5>Roles asignados</h5></p>
                         <table class="table table-striped  table-sm">
                                <thead class="table-dark">
                                    <tr>     
                                    <th>Nombre</th>
                                    <th>Slug</th>   
                                                                     
                                         
                                        <th>Borrar</th>                                     
                                    </tr>
                                </thead>
                                    @foreach($ar as $rol)                                    
                                        <tr>
                                            <td>
                                                {{$rol->roles->descripcion}}
                                            </td>

                                            <td>
                                                {{$rol->roles->slug}}
                                            </td>
                                            
                                            <td  width="10px">
                                                <a href="{{url('/asigna_roles/'.$rol->id) }}" onclick="return confirm('¿Realmente desea elimiar el regisro?')" ><i class="fas fa-trash-alt" style="color:black"></i></a>  
                                            </td>
                                        </tr>
                                
                                     @endforeach
                            </table></h5>
                    </div>

                    
                    <div class="card-footer" align="right">  
                           
                      <a href="{{ url('/usuarios/admin') }}" class="btn btn-dark" ><i class="fas fa-check-circle"></i>Aceptar</a>        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
