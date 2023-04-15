
@extends('adminlte::page')

@section('title', 'Magistrados')

@section('content_header')
<font color="#367068"><h1><i class="fas fa-gavel">Magistradas y Magistrados del Tribunal de Justicia Electoral del Estado de Zacatecas </i></h1></font>
@stop

@section('content')
        <div class="card">
        <div class="card-header">
    
                                                
                        {{ Form::open(['route' => 'admin_magistrado', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
                        
                        {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Escriba nombre']) }}
                        
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-default">
                                    <span class="glyphicon glyphicon-search"><i class="fas fa-search"></i></span>
                                </button>
                            </div>                           
                        {{ Form::close() }}

                    <!--<input class="form-control" placeholder="Escriba el nombre y/o apellidos  de la empleada o empleado" name="nombre">-->

                                <div  align="right">
                                    <a href="{{ route ('create_magistrado' ) }}" class="btn btn-dark"><i class="fas fa-plus-circle"></i>Agregar Magistrado(a)</a>
                                </div>
        </div>    

            
           
    
               <div class=card-body> 
                 <table class="table table-striped  table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Primer Apellido</th>
                            <th>Segundo Apellido</th>
                            <th>Estátus</th>                                                
                             <th>Herramientas</th>
                        </tr>
                    </thead >
                    <tbody>
                        @foreach($magistrados as $magistrado)
                            <tr>
                                <td>{{$magistrado->id }}</td>
                                <td >{{$magistrado->nombre }}</td>
                                <td >{{$magistrado->primerapellido }}</td>
                                <td >{{$magistrado->segundoapellido }}</td>
                                @if($magistrado->activo==0)
                                                <td ><span class="badge badge-secondary">Inactivo(a)</span></td>
                                                @endif
                                                @if($magistrado->activo==1)
                                                <td><span class="badge badge-success">Activo(a)</span></td>
                                                @endif               
                               
                                <td width="10px"><a href="{{ url( 'magistrado/'.$magistrado->id.'/show')}}" title="Detalle magistrado" ><i class="fas fa-eye"  style="color:black"></i></a>
                                <a href="{{ url('/magistrado/'.$magistrado->id.'/edit') }}" title="Editar magistrado"><i class="fas fa-pencil-alt"  style="color:black"></i></a>
                                <a href="{{ route('destroy_magistrado',$magistrado->id) }}" 
                                onclick="return confirm('¿Realmente desea elimiar el regisro?')" title="Elimimnar magistrado" ><i class="fas fa-trash-alt"  style="color:black"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                 </table>
               </div>
               <div class="card-footer" align="right">
                    {{ $magistrados->links() }}
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

