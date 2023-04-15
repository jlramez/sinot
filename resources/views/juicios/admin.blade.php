
@extends('adminlte::page')

@section('title', 'Juicios')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-file-medical"> Juicios de los  expedientes dentro del Notrijez</i></h1></font>
@stop

@section('content')
<div class="card">

                    <div class="card-header">
    
                                                
                            {{ Form::open(['route' => 'admin_juicio', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
                            
                            {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Escriba la actuación']) }}
                            
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">
                                        <span class="glyphicon glyphicon-search"><i class="fas fa-search"></i></span>
                                    </button>
                                </div>                           
                            {{ Form::close() }}

                        <!--<input class="form-control" placeholder="Escriba el nombre y/o apellidos  de la empleada o empleado" name="nombre">-->

                                    <div  align="right">
                                    <a href="{{ route ('create_juicio' ) }}" class="btn btn-dark"><i class="fas fa-plus-circle"></i>Agregar Tipo de Juicio</a>
                                    </div>
                    </div>    
        

               <div class=card-body> 
                 <table class="table table-striped table-hover table-sm">
                    <thead thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th >Nombre</th>                    
                            <th>Nom</th>
                             <th>Herramientas<th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($juicios as $juicio)
                            <tr>
                                <td>{{$juicio->id }}</td>
                                <td >{{$juicio->descripcion }}</td>
                                <td>{{$juicio->nomenclatura}}</td>
                                <td width="10px"><!--<a href="{{ url( '/juicios/'.$juicio->id.'/show')}}" title="Detalle juicio" ><i class="fas fa-eye" style="color:black"></i></a>-->
                                <a href="{{ url('/juicios/'.$juicio->id.'/edit') }}" title="Editar juicio" ><i class="fas fa-pencil-alt" style="color:black"></i></a>
                                <a href="{{ route('destroy_juicio',$juicio->id) }}" onclick="return confirm('¿Realmente desea elimiar el regisro?')"  title="Eliminar juicio"><i class="fas fa-trash-alt" style="color:black"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                 </table>
               </div>
               <div class="card-footer" align="right">
                    {{ $juicios->links() }}
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

