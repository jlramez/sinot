@extends('adminlte::page')

@section('title', 'Actuaciones')

@section('content_header')
    <h1>Actuaciones existentes para  expedientes dentro del Notrijez</h1>
@stop

@section('content')
<div class="card">
<div class="card-header">
    
                        
    {{ Form::open(['route' => 'admin_actuacion', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
      
    {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Escriba la actuación']) }}
    
        
        <div class="form-group">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"><i class="fas fa-search"></i></span>
            </button>
        </div>                           
    {{ Form::close() }}

<!--<input class="form-control" placeholder="Escriba el nombre y/o apellidos  de la empleada o empleado" name="nombre">-->

</div>
    <div align="right">
               <a href="{{ route ('create_actuacion' ) }}" class="btn btn-success"><i class="fas fa-plus-circle"></i>Agregar Actuación</a>
        </div>
    <div class=card-body> 
                 <table class="table table-striped table-hover table-sm">
                    <thead thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>                                               
                             <th>Ver</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($actuaciones as $actuacion)
                            <tr>
                                <td >{{$actuacion->id }}</td>
                                <td >{{$actuacion->Nombre }}</td>
                                <td align="justify-content-center" width="10px"><a href="{{ url( 'actuacion/'.$actuacion->id.'/show')}}"  class="btn btn-primary"><i class="fas fa-eye"></i></a></td>
                                <td align="justify-content-center" width="10px"><a href="{{ url('/actuacion/'.$actuacion->id.'/edit') }}" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a></td>
                                <td width="10px"><a href="{{ route('destroy_actuacion',$actuacion->id) }}"   onclick="return confirm('¿Realmente desea elimiar el regisro?')" class=" btn btn-danger " ><i class="fas fa-minus-circle"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                 </table>
               </div>
               <div class="card-footer" align="right">
                    {{ $actuaciones->links() }}
               </div>         
            </div>

           
        </div>
    </div>
</div>
@stop

@section('css')
    
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    $('.formulario-eliminar').submit(function(e){
        e.preventDefault();
          

    });
  
</script>
@stop


