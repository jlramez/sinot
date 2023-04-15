
@extends('adminlte::page')

@section('title', 'Ponencias')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-briefcase"> Ponencias del Tribunal de Justicia Electoral del Estado de Zacatecas</i></h1></font>
@stop
@section('content')
<div class="card">
                            <div class="card-header">
    
                        
                                    {{ Form::open(['route' => 'admin_ponencia', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
                                    
                                    {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Escriba el área']) }}
                                    
                                        
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-default">
                                                <span class="glyphicon glyphicon-search"><i class="fas fa-search"></i></span>
                                            </button>
                                        </div>                           
                                    {{ Form::close() }}

                                    <!--<input class="form-control" placeholder="Escriba el nombre y/o apellidos  de la empleada o empleado" name="nombre">-->

                                    <div  align="right">
                                    <a href="{{ route ('create_ponencia' ) }}" class="btn btn-dark"><i class="fas fa-plus-circle"></i>Agregar Ponencia</a>
                                    </div>
                            </div>
           
               <div class=card-body> 
                 <table class="table table-striped  table-sm">
                    <thead thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Ponencia</th>
                            <th>Magistrado(a) Instructor(a)</th>                                               
                             <th>Herramientas</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ponencias as $ponencia)
                            <tr>
                                <td>{{$ponencia->id }}</td>
                                <td >{{$ponencia->descripcion }}</td>
                                <td >{{$ponencia->magistrados->nombre }} {{$ponencia->magistrados->primerapellido }} {{$ponencia->magistrados->segundoapellido }}</td>                                         
                                <td width="10px"><a href="{{ url( 'ponencia/'.$ponencia->id.'/show')}}"  ><i class="fas fa-eye" style="color:black"></i></a>
                                <a href="{{ url('/ponencia/'.$ponencia->id.'/edit')}}" ><i class="fas fa-pencil-alt" style="color:black"></i></a>
                                <a href="{{ route('destroy_ponencia',$ponencia->id) }}" onclick="return confirm('¿Realmente desea elimiar el regisro?')"  ><i class="fas fa-trash-alt" style="color:black"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                 </table>
               </div>
               <div class="card-footer" align="right">
                    {{ $ponencias->links() }}
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

