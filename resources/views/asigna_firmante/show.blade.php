<style>
      textarea:focus, input:focus, input[type]:focus 
      {
            border-color: rgb(54, 112, 104);
            box-shadow: 0 1px 1px rgba(54, 112, 104, 0.075)inset, 0 0 8px rgba(54, 112, 104,0.6);
            outline: 0 none;

       }
    
       option:hover {
         background:green
        }
       

  </style>
@extends('adminlte::page')

@section('title', 'Asigna Tareas')

@section('content_header')
    <h1>Empleados de los perfiles de firma del Tribunal de Justicia Electoral del Estado de Zacatecas</h1>
@stop
@blade
@section('content')

               
<div class="card"> 
                <h3>{{ $perfilfirma->descripcion}}</h3>
                   @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status')}}
                            </div>
                   @endif
                    <div class="card-header" align="right">
                    <a href="{{ route('create_addsign',$perfilfirma->id) }}" class="btn btn-dark" ><i class="fas fa-plus-square"></i>Agregar Firmante</a> 
                    </div>
                    <div class="card-body" >
                         <p><h4>Empleados Firmantes:</h4></p>
                         <table class="table table-striped  table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Perfil Firmante</th>
                                        <th>Herramientas</th>
                                      
                                        
                                    
                                    </tr>
                                </thead>
                                    @foreach($af as $firma)                                    
                                        <tr>
                                            <td>
                                                  
                                                {{$firma->empleados->nombre}}   {{$firma->empleados->ap}}   {{$firma->empleados->am}}  
                                                                          
                                            </td>
                                            <td>
                                                {{$perfilfirma->descripcion}}                                        
                                            </td>
                                                                                   
                                            <td width="10px" >
                                                <a href="{{ url('/asigna_tareas/'.$firma->id.'/edit') }}"><i class="fas fa-power-off" style="color:black"></i></a>  
                                            
                                            
                                                <a href="{{ route('destroy_addsign', $firma->id) }}" onclick="return confirm('¿Realmente desea elimiar el regisro?')"   ><i class="fas fa-trash-alt" style="color:black"></i></a>  
                                            </td>
                                        </tr>
                                
                                     @endforeach
                            </table>
                    </div>

                    
                    <div class="card-footer" align="right">  
                         
                      <a href="{{ url('/roles/admin') }}" class="btn btn-dark" ><i class="fas fa-check-circle"></i>Aceptar</a>        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
