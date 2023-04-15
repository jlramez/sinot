@extends('adminlte::page')

@section('title', 'Estátus')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-check-square"> Estatus que guardan los espedientes del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1></font>
@stop

@section('content')
<div class="card">

<div class="card-header">
    
                                    
                {{ Form::open(['route' => 'admin_estatus', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
                
                {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Escriba la actuación']) }}
                
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"><i class="fas fa-search"></i></span>
                        </button>
                    </div>                           
                {{ Form::close() }}

            <!--<input class="form-control" placeholder="Escriba el nombre y/o apellidos  de la empleada o empleado" name="nombre">-->

            <div align="right">
              <a href="{{ route ('create_estatus' ) }}" class="btn btn-dark"><i class="fas fa-plus-circle"></i>Agregar estátus</a>
            </div>
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
                        @foreach($estatus as $estatus)
                            <tr>
                                <td>{{$estatus->id }}</td>
                                <td >{{$estatus->descripcion }}</td>
                                <td width="10px"><a href="{{ url( '/estatus/'.$estatus->id.'/show')}}" title="Detalle estátus" ><i class="fas fa-eye" style="color:black"></i></a>
                                <a href="{{ url('/estatus/'.$estatus->id.'/edit') }}"  title="Editar estátus"><i class="fas fa-pencil-alt" style="color:black"></i></a>
                                <a href="{{ route('destroy_estatus',$estatus->id) }}" onclick="return confirm('¿Realmente desea elimiar el regisro?')" title="Eliminar estátus" ><i class="fas fa-minus-circle" style="color:black"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                 </table>
               </div>
               <div class="card-footer" align="right">
             <!--FALTA LINK-->
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