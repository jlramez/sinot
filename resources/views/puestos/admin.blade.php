@extends('adminlte::page')

@section('title', 'Puestos')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-vote-yea"> Puestos del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1></font>
@stop
@section('content')
<div class="card">
            <div class="card-header">
    
                        
                                {{ Form::open(['route' => 'admin_puesto', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
                                
                                {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Escriba el puesto / área']) }}
                                
                                    
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default">
                                            <span class="glyphicon glyphicon-search"><i class="fas fa-search"></i></span>
                                        </button>
                                    </div>
                                {{ Form::close() }}


                                <div  align="right">
                                    <a href="{{ route ('create_puesto' ) }}" class="btn btn-dark"><i class="fas fa-plus-circle"></i>Agregar Puesto</a>
                                </div>
            </div>
           
               <div class=card-body> 
                 <table class="table table-striped  table-sm">
                    <thead thead class="table-dark"> 
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>  
                            <th>Área</th>                                              
                             <th>Herramientas</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($puestos as $puesto)
                            <tr>
                                <td>{{$puesto->id }}</td>
                                <td >{{$puesto->descripcion }}</td>
                                <td >{{$puesto->areas->descripcion }}</td>
                                <td width="10px"><a href="{{ url( 'puestos/'.$puesto->id.'/show')}}"  ><i class="fas fa-eye" style="color:black"></i></a>
                               <a href="{{ url('/puestos/'.$puesto->id.'/edit') }}" ><i class="fas fa-pencil-alt" style="color:black"></i></a>
                                <a href="{{ route('destroy_puesto',$puesto->id) }}" onclick="return confirm('¿Realmente desea elimiar el regisro?')"  ><i class="fas fa-trash-alt" style="color:black"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                 </table>
               </div>
               <div class="card-footer" align="right">
                    {{ $puestos->links() }}
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

