@extends('adminlte::page')

@section('title', 'Perfil de firmas de usuario(s)')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-pen-alt"> Perfil de firmas de usuario(a)  del Sistema Notrijez</i></h1></font>
@stop
@section('content')
<div class="card">
            <div class="card-header" align="right">
            <input class="form-control" placeholder="Escriba el nombre del rol">
            </div>
            <div align="right">
              <a href="{{ url ('perfilfirma/create' ) }}" class="btn btn-dark"><i class="fas fa-plus-circle"></i>Agregar Perfil de Firmas</a>
            </div>
               <div class=card-body> 
                 <table class="table table-striped  table-sm">
                    <thead thead class="table-dark">                  
                        <tr>
                            <th>ID</th>
                            <th>Nombre perfil</th> 
                            
                            <th>Firmantes</th>      
                            <th>Herramientas</th>
                            
                        </tr>
                    </thead>
                    <tbody> 
                    <tr>  
                    <php? 
                   $id_rol=2;
                   ?>
                    @foreach($perfilfirma as $firma)              
                                    <td>{{$firma->id }}</td>                        
                                    <td >{{$firma->descripcion }}</td> 
                                    <td>
                                      @foreach($firma->empleados as $empleado)
                                      <span class="badge badge-secondary">{{$empleado->nombre}} {{$empleado->ap}} {{$empleado->am}}</span>                                                           
                                      @endforeach
                                    </td>  
                                    <td width="10px"><a href="{{ url( 'asigna_firmas/'.$firma->id.'/show')}}" ><i class="fas fa-eye" style="color:black"></i></a>
                                    <a href="{{ url( 'perfilfirma/'.$firma->id.'/edit')}}"  ><i class="fas fa-pencil-alt" style="color:black"></i></a>
                                    <a href="{{route('destroy_perfilfirma',$firma->id )}}"
                                     onclick="return confirm('¿Realmente desea elimiar el regisro?')" > 
                                     <i class="fas fa-trash-alt" style="color:black"></i></a></td> 
                            </tr>
                        @endforeach
                    </tbody>
                 </table>
               </div>
               <div class="card-footer" align="right">
                   {{ $perfilfirma->links() }}
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

